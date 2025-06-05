<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class KepalaAdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'kepala_admin') {
            return $next($request);
        }

        return abort(403, 'Unauthorized access.');
    }

       

}