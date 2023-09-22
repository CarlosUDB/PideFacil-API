<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\MajorOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        
        //verifying order data
        $validator = Validator::make($request->all(), [
            'dish_id' => 'required|exists:dishes,id',
            'quantity' => 'required|integer|between:0,1000'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }


        //MAJOR ORDEN

        $dish = Dish::find($request->dish_id);

        $major_order_in_progress = MajorOrder::join('orders as o', 'o.major_order_id', '=', 'major_orders.id')
            ->join('dishes as d', 'd.id', '=', 'o.dish_id')
            ->where('d.restaurant_id', $dish->restaurant_id)
            ->where('major_orders.status', 'in_progress')
            ->where('major_orders.user_id', $user_id)
            ->groupBy('major_orders.id')
            ->select('major_orders.*')->get();

        if ($major_order_in_progress && count($major_order_in_progress) > 0) {
            $order = Order::create([
                'dish_id' => $request->dish_id,
                'major_order_id' => $major_order_in_progress[0]->id,
                'quantity' => $request->quantity
            ]);
        } else {
            //creating the major order because there is not a one with in_progress state
            $major_order = MajorOrder::create([
                'user_id' => $request->user_id,
                'status' => 'in_progress'
            ]);

            $order = Order::create([
                'dish_id' => $request->dish_id,
                'major_order_id' => $major_order->id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json([
            'order' => $order
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getActiveOrdersByUserId($id)
    {
        $orders = Order::join('major_orders as mo', 'mo.id', '=', 'orders.major_order_id')
            ->where('mo.status', 'in_progress')
            ->where('mo.user_id', $id)
            ->select('orders.*')->get();

        if ($orders && count($orders) > 0) {
            return response()->json($orders, 200);
        } else {
            return response()->json([
                'message' => "Orders not found."
            ], 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOrdersByMajorOrderId($major_order_id)
    {
        $orders = Order::where('major_order_id', $major_order_id)->get();

        if ($orders && count($orders) > 0) {
            return response()->json(['orders' => $orders], 200);
        } else {
            return response()->json([
                'message' => "Orders not found."
            ], 404);
        }
    }
}
