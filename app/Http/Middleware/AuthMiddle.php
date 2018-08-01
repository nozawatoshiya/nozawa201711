<?php

namespace App\Http\Middleware;

use Closure;
use Larafm;

class AuthMiddle
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
        if(!\Larafm::Auth()->user()){
          return redirect('login');
        }
        return $next($request);
    }
}
