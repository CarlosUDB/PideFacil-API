<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\MajorOrderController;
use App\Http\Controllers\OrderController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth user routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('verify-email', [AuthController::class, 'verifyEmail']);

//protected routes by auth sanctum
Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('users/{id}', [AuthController::class, 'update']);

    //Restaurants routes
    Route::get('restaurants', [RestaurantController::class, 'index']);
    Route::post('restaurants', [RestaurantController::class, 'store']);
    Route::post('restaurants/{id}', [RestaurantController::class, 'update']);
    Route::delete('restaurants/{id}', [RestaurantController::class, 'destroy']);
    Route::get('restaurants/{id}', [RestaurantController::class, 'getResturantById']);

    //Dishes routes
    Route::get('dishes', [DishController::class, 'index']);
    Route::post('dishes', [DishController::class, 'store']);
    Route::post('dishes/{id}', [DishController::class, 'update']);
    Route::delete('dishes/{id}', [DishController::class, 'destroy']);
    Route::get('dishes/{id}', [DishController::class, 'getDishById']);
    Route::get('dishes/restaurant/{id}', [DishController::class, 'getDishesByRestaurantId']);


    //Major orders routes
    Route::get('major-orders', [MajorOrderController::class, 'index']);
    Route::post('major-orders', [MajorOrderController::class, 'store']);
    Route::post('major-orders/{id}', [MajorOrderController::class, 'update']);
    Route::delete('major-orders/{id}', [MajorOrderController::class, 'destroy']);
    
    //Routes to use in restaurants screens
    Route::get('major-orders/completed-by-restaurant/{restaurant_id}', [MajorOrderController::class, 'getCompletedMajorOrdersByRestaurantId']);
    Route::get('major-orders/delivered-by-restaurant/{restaurant_id}', [MajorOrderController::class, 'getDeliveredMajorOrdersByRestaurantId']);
    Route::get('major-orders/by-restaurant/{restaurant_id}', [MajorOrderController::class, 'getMajorOrdersByRestaurantId']);

    //Route to end an order (change major order to completed)
    Route::get('major-orders/complete/{major_order_id}', [MajorOrderController::class, 'changeMajorOrderToCompleted']);

    //Route to get major orders by user_id and the status is different from in_progress, it is used to 'pedidos' in client screen
    Route::get('major-orders/by-user-id/{user_id}', [MajorOrderController::class, 'getMajorOrdersByUserId']);

    //Route to get client address from major order
    Route::get('major-orders/client-info-by-major-order/{major_order_id}', [MajorOrderController::class, 'getClientInfoByMajorOrderId']);

    //Route to mark major order as delivered
    Route::get('major-orders/delivered/{major_order_id}', [MajorOrderController::class, 'changeMajorOrderToDelivered']);



    //Orders routes
    Route::get('orders', [OrderController::class, 'index']);

    //Route to make orders, it manages major orders
    Route::post('orders/{user_id}', [OrderController::class, 'store']);

    //Route to orders screen by user
    Route::get('orders/in-progress-orders-by-user-id/{id}', [OrderController::class, 'getActiveOrdersByUserId']);

    //Route to get orders by major order id
    Route::get('orders/by-major-order-id/{major_order_id}', [OrderController::class, 'getOrdersByMajorOrderId']);

    

    

    

    

});