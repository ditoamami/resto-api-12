<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // ✅ Kalau request ke API, jangan redirect — biarkan handler JSON yang balas
        if ($request->expectsJson() || $request->is('api/*')) {
            return null;
        }

        // Kalau bukan API, baru arahkan ke route login (misal web route)
        return route('login');
    }
}
