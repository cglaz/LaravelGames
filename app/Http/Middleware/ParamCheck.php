<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ParamCheck
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
        if($request->has('page') && $request->get('page') <= 0)
        {
           $newParamValue = $request->merge([
                'page' => 1
            ]);
            dump($newParamValue->input('page'));
        }

        return $next($request);
    }
}
