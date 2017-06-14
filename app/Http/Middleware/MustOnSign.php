<?php

namespace App\Http\Middleware;

use App\Tools\Tools;
use Closure;

use Auth;
use Illuminate\Support\Facades\Session;

class MustOnSign
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

        if (Session::has('member') || Session::has('client')) {
            return $next($request);
        }
        return back();
    }
}
