<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if ($guard == "admin" && Auth::guard($guard)->check()) {
                // return redirect('/admin');
                return redirect(RouteServiceProvider::ADMIN);
            }

            if ($guard == "seller" && Auth::guard($guard)->check()) {
                // return redirect('/seller');
                return redirect(RouteServiceProvider::SELLER);
            }    

            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        /** ======  OR ======== */
        //   foreach ($guards as $guard) {
        //     switch ($guard) {
        //         case 'admin':
        //         if(Auth::guard($guard)->check()){
        //             // return redirect()->route('admin.dashboard');
        //             return redirect(RouteServiceProvider::ADMIN);
        //         }
        //         break;
                
        //         case 'seller':
        //             if(Auth::guard($guard)->check()){
        //                 // return redirect()->route('seller.dashboard');
        //                 return redirect(RouteServiceProvider::SELLER);
        //             }
        //         break;  
                    
        //         default:
        //             if (Auth::guard($guard)->check()) {
        //                 return redirect(RouteServiceProvider::HOME);
        //             }
        //         break;  
        //     }
        //   }
 
    
        return $next($request);
    }
}
