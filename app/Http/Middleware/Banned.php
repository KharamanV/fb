<?php

namespace App\Http\Middleware;

use Closure;

class Banned
{
    /**
     * Handles banned users
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->isBanned()) {
            abort(404);
        }

        return $next($request);
    }
}
