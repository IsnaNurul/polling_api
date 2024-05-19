<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }
    
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'divisi' => 'required|string|',
            'password' => 'required|string|min:3'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'divisi' => $request->divisi,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User Create Successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function reset(Request $request){
        $validator = validator::make($request->all(),[
            'old_password' => 'required|',
            'new_password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'validations fails',
            ],422);
        }

        $user = $request->user();
        if (Hash::check($request->old_password,$user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password) 
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Password Successfully updated',
            ],200);
        }else{
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Old password does not matched',
            ],422);
        }
    }

    public function logout(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function show(){
        return response()->json([
            'status' => 'success',
            'users' => User::all()
        ]);
    }
}
