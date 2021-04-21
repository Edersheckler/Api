<?php

namespace App\Http\Middleware;

use App\Models\Client;
use Closure;

class SecurityMiddleware 
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
        if ( !$request->header('clientid') || !$request->header('clientsecret') )
            return response('Unauthorized.', 401);

        $clientId = $request->header('clientid');
        $secret = $request->header('clientsecret');

        $validCredentials = Client::credentials($clientId,$secret)->first();

        if (!$validCredentials ){
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }

}