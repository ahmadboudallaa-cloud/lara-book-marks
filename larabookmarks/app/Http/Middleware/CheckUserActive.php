<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_active == 0) {
            Auth::logout();

            return redirect()->route('login')
                ->withErrors([
                    'email' => 'Votre compte est désactivé. Veuillez contacter l’administrateur.'
                ]);
        }

        return $next($request);
    }
}
