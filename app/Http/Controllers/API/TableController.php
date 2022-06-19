<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{
    public function check_availability(Request $request)
    {
        $from = Carbon::parse($request->from)->timestamp;
        $to = Carbon::parse($request->to)->timestamp;

        $selected_table = Reservation::whereNotBetween('from_time',  [$from, $to])
            ->whereNotBetween('to_time',  [$from, $to])
            ->where('table_id', $request->table_id)
            ->whereHas('table', function ($q) use ($request) {
                return $q->where('capacity', '>=', $request->capacity);
            })
            ->get();
        if (count($selected_table) > 0) {
            return response()->json([
                "message" => "Table is available"
            ], 200);
        } else {
            return response()->json([
                "message" => "Table is not available"
            ], 200);
        }
    }
}
