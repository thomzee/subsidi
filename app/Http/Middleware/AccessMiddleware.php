<?php

namespace App\Http\Middleware;

use Closure;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $action
     * @param $slug
     * @return mixed
     */
    public function handle($request, Closure $next, $action, $slug = null)
    {
        if (!check_access($action, $slug)) {
            abort(403);
        }
        return $next($request);
    }
}
