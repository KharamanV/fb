<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handles users by roles, which defined in route parameters
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        if ($request->user()->hasAnyRole($roles) || !$roles) {
            return $next($request);
        }
        
        abort(403, 'У вас нет прав для просмотра этой страцниы');
    }
}
