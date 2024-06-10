<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class SetLocale
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
        if (auth()->guest()) {
            if (!Cookie::has('cart_token')) {
                Cookie::queue('cart_token', md5(time().$request->ip()), 30000);
            }
        }

        if (Cookie::has('locale')) {
            $locale = Cookie::get('locale');
            App::setLocale($locale);
        }
        return $next($request);
    }
}
