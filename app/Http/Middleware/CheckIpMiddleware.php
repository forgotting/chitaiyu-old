<?php

namespace App\Http\Middleware;

use Closure;
use App\CheckIp;

class CheckIpMiddleware
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
        $clientIp = $this->getIpAddress();

        if (!in_array($clientIp, $this->getIp())) {
    
            /*
                 You can redirect to any error page. 
            */
            return response()->json($clientIp, 401);
        }
        
        return $next($request);
    }
    
    private function getIpAddress() {
        
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddresses = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim(end($ipAddresses));
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    private function getIp() {
        $ips = new CheckIp;
        $ips = $ips::where('iswhite', 1)->get();
        $iplist = [];

        foreach ($ips as $ip) {
            $iplist[] = $ip->ip;
        }

        return $iplist;
    }
}
