<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access. Admin privileges required.');
        }

        // Ensure only one admin can access - only the first admin (by ID) is allowed
        $firstAdmin = User::where('is_admin', true)->orderBy('id', 'asc')->first();
        
        if ($firstAdmin && Auth::id() !== $firstAdmin->id) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            abort(403, 'Only one admin account is allowed. Please contact the system administrator.');
        }

        return $next($request);
    }
}
