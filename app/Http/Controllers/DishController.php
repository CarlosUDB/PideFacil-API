<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Dish::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //verifying restaurant data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'picture' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,999.99',
            'restaurant_id' => 'required|exists:restaurants,id'            
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }

        $picture_path = $request->file('picture')->store('images', 'public');


        //creating the dish
        $dish = Dish::create([
            'name' => $request->name,
            'picture' => $picture_path,
            'description' => $request->description,
            'price' => $request->price,
            'restaurant_id' => $request->restaurant_id
        ]);


        return response()->json([
            'dish' => $dish
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //verifying dish data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',            
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,999.99',
            'restaurant_id' => 'required|exists:restaurants,id',
            'picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }

        $dish = Dish::find($id);
        $picture_path = $dish->picture;

        if ($request->file('picture')) {
            //uploading new logo
            $picture_path = $request->file('picture')->store('images', 'public');
        }

        $dish->update([
            'name' => $request->name,
            'picture' => $picture_path,
            'description' => $request->description,
            'price' => $request->price,
            'restaurant_id' => $request->restaurant_id
            
        ]);

        return response()->json([
            'dish' => $dish
        ], 200);
    }

    /**
     * Get a dish by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDishById($id)
    {   
        $dish = Dish::find($id);

        if ($dish) {
            return response()->json([
                'dish' => $dish
            ], 200);
        } else {
            return response()->json([
                'message' => "Dish doesn't exist."
            ], 404);
        }
    }

    /**
     * Get a dishes by restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDishesByRestaurantId($id)
    {

        $dishes = Dish::where('restaurant_id', $id)->get();
        
        if ($dishes && count($dishes) > 0) {
            return response()->json($dishes, 200);
        } else {
            return response()->json([
                'message' => "Dishes not found."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish = Dish::find($id);

        if ($dish) {
            $dish->delete();
            $message = 'Dish deleted.';
        } else {
            $message = "Dish doesn't exist.";
        }

        return response()->json([
            'message' => $message
        ]);
    }
}
