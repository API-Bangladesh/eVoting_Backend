<?php

namespace App\Http\Middleware;

use App\Facades\Setting;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserLoginStatus
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
        if(Auth::check()){
            if(Auth::user()->hasRole(Role::TYPE_SUPER_ADMIN)){
                return $next($request);
            }

            if(Setting::get('disable_common_users_login')){
                Auth::logout();
                return redirect('/')->with('error', 'Currently the login system is postponed.');
            }
        }

        return $next($request);
    }
}
