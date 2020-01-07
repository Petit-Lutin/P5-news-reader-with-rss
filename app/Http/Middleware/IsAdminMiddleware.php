<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
{
    /** * Handle an incoming request. * * @param \Illuminate\Http\Request $request * @param \Closure $next * @return mixed */
    public function handle($request, Closure $next)
    {
        if (Auth::guest() || !Auth::user()->is_admin) {
            session(['url.intended' => url()->current()]);
            return response()->redirectTo("/login");
        }
        return $next($request);
    }
}
