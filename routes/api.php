<?php

use App\Http\Controllers\API\MealController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\TableController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('check/available',[TableController::class, 'check_availability']);
Route::post('reserve',[ReservationController::class, 'reserve_table']);
Route::post('create/order',[OrderController::class, 'create_order']);
Route::get('menu',[MealController::class,'list_items']);
Route::get('invoice/{order_id}',[OrderController::class,'invoice']);
