<?php

namespace App\Http\Middleware;

use App\Tools\Tools;
use Closure;

use Auth;

class MustOnAdmin
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
        $routeName = $request->route()->getName();

        if (Auth::check() && Auth::user()->is_admin == 1) {

            if (Auth::user()->can($routeName) || true) {
                return $next($request);
            }

            return view('admin.layouts.stop');

        }

        /**
         * sadasdas
         */
        return Tools::notifyTo('请登录','admin.login');
    }
}
