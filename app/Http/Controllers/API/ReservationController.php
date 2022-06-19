<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\WaitingList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function reserve_table(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_id' => 'required|exists:tables,id',
            'customer_id' => 'required|exists:customers,id',
            'from_time' => 'required|date_format:Y-m-d H:i:s|after:' . date(DATE_ATOM),
            'to_time' =>'required|date_format:Y-m-d H:i:s|after:' . date(DATE_ATOM),
      ]);
      
      if ($validator->fails()) {
         return response()->json($validator->errors(), 404);
      }
        $total_capacity = Table::get()->sum('capacity');

        $reserved_tables = Table::whereHas('reservations', function ($query) use ($request) {
            $query->where('from_time', '<=', Carbon::parse($request->from_time)->timestamp)
                ->where('to_time', '>=', carbon::parse($request->to_time)->timestamp);
        })->get();

        $allowed_capacity = $total_capacity - $reserved_tables->sum('capacity');

        $reserved_table_ids = $reserved_tables->pluck('id')->toArray();
        if ($request->capacity <= $allowed_capacity) {
            if (!in_array($request->table_id, $reserved_table_ids)) {
                $reservation = new Reservation();
                $reservation->table_id = $request->table_id;
                $reservation->customer_id = $request->customer_id;
                $reservation->from_time = Carbon::parse($request->from_time)->timestamp;
                $reservation->to_time = Carbon::parse($request->to_time)->timestamp;
                $reservation->save();
                return response()->json([
                    "message" => "reservaition is Created Successfully",
                ], 200);
            } else {
                return response()->json([
                    "message" => "This table is already reserved, please choose another table",
                ], 200);
            }
        } else {
            $waiting = new WaitingList();
            $waiting->customer_id = $request->customer_id;
            $waiting->from_time = Carbon::parse($request->from_time)->timestamp;
            $waiting->to_time = Carbon::parse($request->to_time)->timestamp;
            $waiting->capacity = $request->capacity;
            $waiting->save();
            return response()->json([
                "message" => "your reservation is added to waiting list",
            ], 200);
        }
    }
}