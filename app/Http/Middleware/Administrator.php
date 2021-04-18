<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use Auth;
class Administrator
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
        if( !Auth::check() ){
            return redirect( route('login'));
        }


        if( Auth::user()->role[0]->title !== 'Administrator'){
            
            return redirect( route('home') );
        }

        return $next($request);
    }
}
