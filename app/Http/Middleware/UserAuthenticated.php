<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserAuthenticated
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
        if( Auth::check() )
        {

            // if ( Auth::user()->isAdmin() ) {
            //      return redirect(route('employees'));
            // }


            // else if ( Auth::user()->isUser() ) {
            //      return $next($request);
            // }

            if ( Auth::user()->isUser() || Auth::user()->isAdmin()) {
                return $next($request);
            }
        }

        abort(404);
    }
}
