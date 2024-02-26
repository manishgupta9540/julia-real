<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {  
            $userLastActivity = Session::get('lastActivity', now());

            if (now()->diffInMinutes($userLastActivity) >= config('session.lifetime')) {
                Auth::logout();
                Session::flush();
    
                return redirect()->route('admin/login')->with('status', 'Your session has expired. Please log in again.');
            }

            if(Auth::user()->user_type == '0')
            {
                return $next($request);
            }
            
            if(Auth::user()->user_type == '1')
            {
                return $next($request);
            }
        }
        return redirect()->route('admin/login');
        
        

    }
}
