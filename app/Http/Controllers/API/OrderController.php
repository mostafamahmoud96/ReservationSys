<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function create_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_id' => 'required|exists:tables,id',
            'customer_id' => 'required|exists:customers,id',
            'waiter_id' => 'required|exists:waiters,id',
            'total' => 'required|numeric',
            'paid' => 'required|numeric',
            'date' => 'required|date|after_or_equal:today',
            'meal_ids' => 'required|array|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        try {
            DB::beginTransaction();
            //create new order for reservation
            $order = new Order();
            $order->table_id = $request->table_id;
            $order->customer_id = $request->customer_id;
            $order->waiter_id = $request->waiter_id;
            $order->reservation_id = $request->reservation_id;
            $order->total = $request->total;
            $order->paid = $request->paid;
            $order->date = $request->date;
            $order->save();
            // Add meals to order
            if ($request->meal_ids) {
                $amount_to_pay = [];
                foreach ($request->meal_ids as $meal) {
                    $this_meal = Meal::find($meal);
                    $amount_to_pay[$meal] = ['amount_to_pay' => $this_meal->price - (($this_meal->price) * ($this_meal->discount_percentage / 100))];
                }

                $order->meals()->sync($amount_to_pay);
            }
            DB::commit();
            return response()->json([
                "message" => "order is Created Successfully",
            ], 200);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json([
                "message" => $ex->getMessage()
            ], 400);
        }
    }

    // Print Invoice for Order
    public function invoice($order_id)
    {
        if (Order::where('id', $order_id)->exists()) {
            $order = Order::find($order_id)->toArray();
            // dd($order);
            $pdf = Pdf::loadView('invoice', ['order_id' => $order_id]);
            return $pdf->stream('invoice');
        } else {
            return response()->json([
                "message" => "No Data Found"
            ], 200);
        }
    }
}
