<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UpdateCustomerLastActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();

            // Only write if last_active is older than 30 seconds (reduce DB writes)
            if (!$user->last_active || $user->last_active->diffInSeconds(now()) > 30) {
                $user->last_active = now();
                $user->save();
            }
        }

        return $next($request);
    }
}
