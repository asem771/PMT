<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeveloperAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        // Allow automated tests to access protected routes.
        if (app()->environment('testing')) {
            return $next($request);
        }

        // Allow access after successful password verification.
        if (session('developer_authenticated') === true) {
            return $next($request);
        }

        // Return JSON response for API requests.
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Developer authentication required.',
            ], 401);
        }

        session(['developer_redirect' => $request->getRequestUri()]);

        return redirect()->route('developer.login');
    }
}
