<?php

namespace App\Http\Middleware;

use Closure;

class NotBanned
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
        if ($user = $request->user()) {
            if ($user->isBanned()) {
                if ($user->shouldUnBan()) {
                    $user->unBan();
                    return $next($request);
                } else {
                    return redirect()->route('banned');
                }
            }
        }
        return $next($request);
    }
}
