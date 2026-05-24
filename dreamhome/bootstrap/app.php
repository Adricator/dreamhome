<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Register your 'role' middleware alias here:
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Check if the user is even logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Get the authenticated user/staff member
        $user = Auth::user();

        // 3. Check if their role matches any of the allowed roles passed to the middleware
        // Adjust 'role' to match the actual column name in your staff/users table (e.g., $user->role)
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // If they don't have access, block them
        abort(403, 'Unauthorized action. You do not have the required permissions.');
    }
}