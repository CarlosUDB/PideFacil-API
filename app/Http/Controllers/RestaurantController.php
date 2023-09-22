<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Restaurant::all();
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
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }

        $logo_path = $request->file('logo')->store('images', 'public');


        //creating the resturant
        $restaurant = Restaurant::create([
            'name' => $request->name,
            'logo' => $logo_path
        ]);


        return response()->json([
            'restaurant' => $restaurant
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {        
        //verifying restaurant data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }

        $restaurant = Restaurant::find($id);
        $logo_path = $restaurant->logo;

        if ($request->file('logo')) {
            //uploading new logo
            $logo_path = $request->file('logo')->store('images', 'public');
        }
        
        $restaurant->update([
            'name' => $request->name,
            'logo' => $logo_path
        ]);

        return response()->json([
            'restaurant' => $restaurant
        ], 200);
    }

    /**
     * Get a restaurant by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getResturantById($id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant) {
            return response()->json([
                'restaurant' => $restaurant
            ], 200);
        } else {
            return response()->json([
                'message' => "Restaurant doesn't exist."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        
        if($restaurant){
            $restaurant->delete();
            $message = 'Restaurant deleted.';
        }else{
            $message = "Restaurant doesn't exist.";
        }        
        
        return response()->json([
            'message' => $message
        ]);
    }
}
