<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Try default web guard first, then admin guard. Determine redirect target by route prefix.
        if (! auth()->check() && ! auth('admin')->check()) {
            $prefix = $request->route() ? $request->route()->getPrefix() : null;

            if ($prefix && str_starts_with($prefix, '/admin') || $request->is('admin/*')) {
                return redirect()->route('admin.login');
            }

            return redirect()->route('auth.login');
        }

        // Prefer the currently authenticated user on web, otherwise admin guard
        $user = auth()->check() ? auth()->user() : auth('admin')->user();

        $userRole = $user->role ?? null;

        // If roles were provided to the middleware, ensure the user has one of them
        if (count($roles) > 0 && ! in_array($userRole, $roles)) {
            abort(403, 'Unauthorized. Your role does not have access to this area.');
        }

        return $next($request);
    }
}
