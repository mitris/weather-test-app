<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Closure;

class AddGlobalFn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $Fn = new class
        {
            public function __call($name, $args)
            {
                if (function_exists($name)) {
                    return call_user_func_array($name, $args);
                }
            }
        };

        View::share('Fn', $Fn);

        $request->attributes->set('Fn', $Fn);

        return $next($request);
    }
}
