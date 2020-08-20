<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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


        $user=Auth::user();
        // $user=$request->user();
            if(!$user){
            return route('login');
              }
              if($user->isAdmin != 1){

                return response('Your not Admin !!');
              }
                 return $next($request);
}

}
