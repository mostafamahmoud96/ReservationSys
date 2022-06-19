<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function list_items()
    {
        $meals = Meal::all()->reject(function ($meal) {
            return $meal->orders()->whereDate('orders.date', Carbon::today())->count() >= $meal->quantity_available;
        })->values()->all();

        if (count($meals) > 0) {
            return response()->json(['data' => $meals], 200);
        } else {
            return response()->json(['message' => 'No Meals Are Available'], 200);
        }
    }
}
