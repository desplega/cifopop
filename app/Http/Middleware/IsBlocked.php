<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isBlocked())
            abort(403, __('You have been blocked. Please contact with the Administrator.'));

        return $next($request);
    }
}
