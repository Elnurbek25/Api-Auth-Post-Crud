<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user =User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt( $request->password),
            ]);
            $token =$user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'token'=>$token,
                'user'=>$user
            ]);
    }
  

    public function login(LoginRequest $request)
    {
        $user=User::where('email',$request->email)->first();

        if(!$user ||!Hash::chek($request->password,$user->password)){
            return response()->json([
                'message' => 'Notogri Email yoki parol'
            ], 401);
    }
    $user->tokens->delete();
    $token =$user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token'=>$token,
        'user'=>$user
    ]);
    }

    public function logout(Request $request){
        $user=$request->user();
        $user->tokens->delete();
        return response()->json([
            'message'=>'Siz logout qildingiz'
        ]);
    }



}