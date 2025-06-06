<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) {
            if(Auth::user()->role == 'owner') {
                return $next($request);
            } else {
                return abort(403, 'Unauthorized access.');
            }
        }
        return redirect()->route('login');

    }


}