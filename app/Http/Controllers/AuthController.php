<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return response()->json($this->authService->register($request->validated()));
    }

    public function login(LoginRequest $request)
    {
        return response()->json($this->authService->login($request->validated()));
    }

    public function logout(Request $request)
    {
        return response()->json($this->authService->logout($request->user()));
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return response()->json($this->authService->forgotPassword($request->email));
    }

    public function authMenu(Request $request)
    {
        return response()->json($this->authService->authMenu($request->user()));
    }
}
