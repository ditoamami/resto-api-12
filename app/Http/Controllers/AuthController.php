<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $req){
        $data = $req->validated();
        $user = User::create($data);
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['user'=>$user,'token'=>$token],201);
    }
    
    public function login(LoginRequest $req){
        $creds = $req->validated();
        if(!auth()->attempt($creds)){
            return response()->json(['message'=>'Invalid credentials'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['user'=>$user,'token'=>$token]);
    }

    public function logout(Request $req){
        $req->user()->currentAccessToken()->delete();
        
        return response()->json(['message'=>'Logged out']);
    }
}