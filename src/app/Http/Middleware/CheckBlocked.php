<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Attempting;

class CheckBlocked
{
    public function handle($request, Closure $next)
    {
         $msg = [];
        if (Auth::check() && Auth::user()->isblocked())
        {
            Auth::logout();
            array_push($msg, "A fiókodat blokkolták! ");
            return redirect()->route('login')->withErrors($msg); //ez csak a login sreent mutatja persze
        }

        return $next($request);
    }
}
