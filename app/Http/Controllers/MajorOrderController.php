<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MajorOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MajorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MajorOrder::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verifying major order data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'status' => 'in:in_progress,delivered'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }

        //creating the major order 
        $major_order = MajorOrder::create([
            'user_id' => $request->user_id,
            'status' => $request->status
        ]);


        return response()->json([
            'major_order' => $major_order
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MajorOrder  $majorOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //verifying major_order data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'status' => 'in:in_progress,delivered'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }


        $major_order = MajorOrder::find($id);

        if ($major_order) {
            //updating the major order 
            $major_order->update([
                'user_id' => $request->user_id,
                'status' => $request->status
            ]);

            return response()->json([
                'major_order' => $major_order
            ], 200);
        } else {
            return response()->json([
                'message' => "Major order doesn't exist."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MajorOrder  $majorOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $major_order = MajorOrder::find($id);

        if ($major_order) {
            $major_order->delete();
            $message = 'Dish deleted.';
        } else {
            $message = "Dish doesn't exist.";
        }

        return response()->json([
            'message' => $message
        ]);
    }

    /**
     * Get major orders with in_progress status by restaurant id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCompletedMajorOrdersByRestaurantId($restaurant_id)
    {
        $major_orders = MajorOrder::join('orders as o', 'o.major_order_id', '=', 'major_orders.id')
            ->join('dishes as d', 'd.id', '=', 'o.dish_id')
            ->where('d.restaurant_id', $restaurant_id)
            ->where('major_orders.status', 'completed')
            ->groupBy('major_orders.id')
            ->select(
                'major_orders.*'
            )->get();

        if ($major_orders && count($major_orders) > 0) {
            return response()->json($major_orders, 200);
        } else {
            return response()->json([
                'message' => "Major orders not found."
            ], 404);
        }
    }

    /**
     * Get major orders with delivered status by restaurant id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeliveredMajorOrdersByRestaurantId($restaurant_id)
    {
        $major_orders = MajorOrder::join('orders as o', 'o.major_order_id', '=', 'major_orders.id')
            ->join('dishes as d', 'd.id', '=', 'o.dish_id')
            ->where('d.restaurant_id', $restaurant_id)
            ->where('major_orders.status', 'delivered')
            ->groupBy('major_orders.id')
            ->select('major_orders.*')->get();

        if ($major_orders && count($major_orders) > 0) {
            return response()->json($major_orders, 200);
        } else {
            return response()->json([
                'message' => "Major orders not found."
            ], 404);
        }
    }

    /**
     * Get
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeMajorOrderToCompleted($major_order_id)
    {
        $major_order = MajorOrder::find($major_order_id);

        if ($major_order) {
            $major_order->update(['status' => 'completed']);
            return response()->json($major_order, 200);
        } else {
            return response()->json([
                'message' => "Major order not found."
            ], 404);
        }
    }

    /**
     * Get
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeMajorOrderToDelivered($major_order_id)
    {
        $major_order = MajorOrder::find($major_order_id);

        if ($major_order) {
            $major_order->update(['status' => 'delivered']);
            return response()->json($major_order, 200);
        } else {
            return response()->json([
                'message' => "Major order not found."
            ], 404);
        }
    }

    /**
     * Get
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMajorOrdersByUserId($user_id)
    {
        $major_orders = MajorOrder::where('user_id', '=', $user_id)
            //->where('status', '!=', 'in_progress')
            ->orderBy('status')->select('*')->get();

        if ($major_orders) {
            return response()->json($major_orders, 200);
        } else {
            return response()->json([
                'message' => "Major orders not found."
            ], 404);
        }
    }

    /**
     * Get
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMajorOrdersByRestaurantId($restaurant_id)
    {
        $major_orders = MajorOrder::join('orders as o', 'o.major_order_id', '=', 'major_orders.id')
            ->join('dishes as d', 'd.id', '=', 'o.dish_id')
            ->where('d.restaurant_id', $restaurant_id)
            ->groupBy('major_orders.id')
            ->orderBy('major_orders.status')
            ->select('major_orders.*')->get();

        if ($major_orders && count($major_orders) > 0) {
            return response()->json(['major_orders' => $major_orders], 200);
        } else {
            return response()->json([
                'message' => "Major order not found."
            ], 404);
        }
    }

    /**
     * Get
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getClientInfoByMajorOrderId($major_order_id)
    {
        $address = User::join('major_orders as mo', 'mo.user_id', '=', 'users.id')
            ->where('mo.id', $major_order_id)
            ->select('users.address', 'users.first_name', 'users.last_name')->get();

        if ($address) {
            return response()->json($address);
        } else {
            return response()->json([
                'message' => "Address not found."
            ], 404);
        }
    }
}
