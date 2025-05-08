<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class KepalaAdminMiddleware
{
    public function handle(Request $request, Closure $next):Response
    {
        if(Auth::check())
        {
            if(Auth::user()->role == 'kepala_admin')
            {
                return $next($request);
            }
            else 
            {
                Auth::logout();
                return redirect(url('login'));
            }
        }
        else 
        {
            Auth::logout();
            return redirect(url('login'));
        }
       
}
}