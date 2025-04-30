<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('organization')->check()) {
            return redirect()->route('organization.login');
        }

        return $next($request);
    }
}