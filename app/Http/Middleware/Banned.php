<?php

namespace App\Http\Middleware;

use Closure;

class Banned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->isBanned()) {
            return response('Такой страницы не существует', 404);
        }

        return $next($request);
    }
}
