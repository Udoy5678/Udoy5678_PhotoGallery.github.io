<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class checkuser
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

        if(Session::has('user_id')===null)
        {
           // dd(Session::has('email'));
         
            return redirect('/');
        }
        
        
        return $next($request);
        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
 ->header('Pragma','no-cache')
 ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
 
    }
}
