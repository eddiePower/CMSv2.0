<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models;

class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //if the user is a admin or editor then send them to next middleware.
        if (Auth::check() && Auth::User()->hasAnyRoles(["Admin", "Editor"])) {
            return $next($request);
        }

        //otherwise just send them home page.
        return redirect("/");
    }
}
