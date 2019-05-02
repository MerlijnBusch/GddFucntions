<?php

namespace App\Http\Middleware;

use Closure;

class IsModerator
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
        if(auth()->user()->isModerator()) {
            return $next($request);
        }
        return redirect('home');
    }
}
