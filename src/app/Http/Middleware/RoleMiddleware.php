<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRoles = auth()->user()->roles;
        $check = false;
        foreach($userRoles as $role) {
            if(in_array($role->name, $roles)){
                $check = true;  
            }
        }
        if($check == false) {
            abort(401);
        }
        return $next($request);
    }
}
