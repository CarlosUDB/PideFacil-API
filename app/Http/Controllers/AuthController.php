<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request){

        //verifying user data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:255',
            'user_type' => 'required|string',
            'restaurant_id' => 'nullable|exists:restaurants,id'
        ]);

        //in case of errors sending them
        if($validator->fails()){
            return response()->json([
                $validator->errors()
            ], 406);
        }

        //creating the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'user_type' => $request->user_type,
            'restaurant_id' => $request->restaurant_id
        ]);

        //creating token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    public function update(Request $request, $id)
    {

        //verifying user data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id . ',id',
            'password' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'user_type' => 'required|string',
            'restaurant_id' => 'nullable|exists:restaurants,id'
        ]);

        //in case of errors sending them
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 406);
        }

        $user = User::find($id);

        //creating the user
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'user_type' => $request->user_type,
            'restaurant_id' => $request->restaurant_id
        ]);

        return response()->json([
            'data' => $user
        ], 200);
    }

    public function login(Request $request){
        //doesnt match an user, sends fail message
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json(
                ['message' => 'Unauthorized.']
            ,401);
        }
        //searching for user
        $user = User::where('email', $request->email)->firstOrFail();
        //creating token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in as ' . $user->first_name,
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);        
    }

    public function verifyEmail(Request $request)
    {
        $exists = false;
        $user = User::where('email', $request->email)->first();
        //dd($user);
        if($user)$exists = true;        

        return response()->json([
            'exists' => $exists
        ]);
        
    }

    public function logout(){
        //deleting tokens
        auth()->user()->tokens()->delete();
        
        return response()->json([
            'message' => 'Logged out, tokens deleted'
        ]);   
    }
}
