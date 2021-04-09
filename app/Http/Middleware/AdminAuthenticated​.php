<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminAuthenticated​
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

            if ( Auth::user()->isUser() ) {
                 return redirect(route('dashboard'));
            }


            else if ( Auth::user()->isAdmin() ) {
                 return $next($request);
            }
        }

        abort(404);
    }
}
