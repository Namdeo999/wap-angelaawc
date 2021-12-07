<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
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
        if($request->session()->has('USER_LOGIN'))
        {
           
        }else{
            $request->session()->flash('msg','User access denied');
            return redirect('/');
        }
        return $next($request);
    }
}
