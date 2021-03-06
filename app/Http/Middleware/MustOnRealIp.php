<?php

namespace App\Http\Middleware;

use App\Models\RealIp;
use App\Tools\Tools;
use Closure;
use Illuminate\Support\Facades\Session;

class MustOnRealIp
{
    /**
     * Handle an incoming request.
     * $request->getClientIp()
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            !Session::has('clientRealIp') &&
            !Session::has('clientRealName') &&
            !Session::has('clientId')
        ) {

            foreach (RealIp::all() as $ip) {
                $startTime = strtotime($ip->client->start_ip);
                $endTime = strtotime($ip->client->end_ip);

                if(
                    Tools::check($ip->ip,$request->getClientIp())
//                    Tools::check($ip->ip,'192.168.0.255')
                    && ($startTime < time() && time() < $endTime)
                ) {
                    Session::put('clientRealIp', $ip->ip);
                    Session::put('clientRealName', $ip->client->name);
                    Session::put('clientId', $ip->client->id);
                    Session::put('clientLogo',$ip->client->logo);
                    Session::put('navclient',$ip->client);
                    return $next($request);
                }
            }
            return redirect('/member/sign');
        }
        return $next($request);
    }
}
