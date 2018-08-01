<?php

namespace App\Http\Middleware;

use Closure;
use Larafm;

class EditMiddle
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
      if(Larafm::Auth()->user()->権限!='管理者'){
        return redirect('attend');
      }
        return $next($request);
    }
}
