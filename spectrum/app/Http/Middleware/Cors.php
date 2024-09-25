<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $domains = ['http://localhost:8008'];

        if(isset($request->server()['HTTP_ORIGIN'])){
           $origin = $request->server()['HTTP_ORIGIN'];
           if(in_array($origin, $domains)){
            header('Access-Control-Allow-Origin: '.$origin);
            header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
           }
        }
        return $next($request);
    }
}
