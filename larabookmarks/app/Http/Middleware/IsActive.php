<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsActive
{
    public function handle(Request $request, Closure $next): Response
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
