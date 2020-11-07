<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class PassUserId
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

// dd('dsfds');
        URL::defaults(['username' => '1' ]);        // dd($request);
        return $next($request);
    }
}
