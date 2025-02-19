<?php

namespace App\Http\Middleware;

use App\Constants;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user){
            if($user->is_admin == Constants::USER_ADMIN){
                return $next($request);
            }else{
                auth()->logout();
                return redirect()->route('login');
            }
        }else{
            auth()->logout();
            return redirect()->route('login');
        }
    }
}
