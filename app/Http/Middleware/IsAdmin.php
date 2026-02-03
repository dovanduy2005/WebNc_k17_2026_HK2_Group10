<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Try to get user from either guard
        $user = auth()->guard('admin')->user() ?? auth()->guard('web')->user();

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('admin.login');
        }

        // Synchronize guards: if logged into web but not admin, or vice versa
        if (!auth()->guard('admin')->check()) {
            auth()->guard('admin')->login($user);
        }
        
        if (!auth()->guard('web')->check()) {
            auth()->login($user);
        }

        return $next($request);
    }
}
