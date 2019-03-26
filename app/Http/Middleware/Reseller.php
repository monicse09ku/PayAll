<?php
namespace App\Http\Middleware;

use Closure;
use Auth;
class Reseller
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
        if (Auth::check() && Auth::user()->role == 'reseller') {
            $request->session()->put('authorised', true);
            return $next($request);
        }
        /*elseif (Auth::check() && Auth::user()->role == 'agent') {
            return redirect('/agent');
        }*/
        else {
            $request->session()->put('authorised', false);
            return redirect('/login');
        }
    }
}
