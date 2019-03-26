<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
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
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->session()->put('authorised', true);
            return $next($request);
        }
        else {
            $request->session()->put('authorised', false);
            return redirect('/login');
        }
    }
}
