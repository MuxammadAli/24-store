<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuth
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
        $username = $request->header('php-auth-user');
        $password = $request->header('php-auth-pw');
        abort_if(
            env('API_USERNAME') != $username and env('API_PASSWORD') != $password,
            401
        );
        if (empty($request->files)) {
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Content-Type', 'application/json');
        }
        return $next($request);
    }
}
