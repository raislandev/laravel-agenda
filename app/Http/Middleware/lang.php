<?php

namespace App\Http\Middleware;

use Closure;

class lang
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
        $lang = session('key', 'en');
        \App::setLocale($lang);  
        return $next($request);
    }
}
