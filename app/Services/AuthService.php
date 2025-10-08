<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout($user)
    {
        $user->tokens()->delete();
        return ['message' => 'Logout berhasil.'];
    }

    public function forgotPassword(string $email)
    {
        $status = Password::sendResetLink(['email' => $email]);
        return $status === Password::RESET_LINK_SENT
            ? ['message' => 'Link reset password dikirim ke email.']
            : ['message' => 'Gagal mengirim link reset password.'];
    }

    public function authMenu($user)
    {
        return [
            'user' => $user,
            'menus' => match($user->role) {
                'kasir' => ['payments', 'orders', 'tables'],
                'pelayan' => ['orders', 'tables', 'menus'],
                default => [],
            },
        ];
    }
}
