<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfPerson
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'person')
	{
	    if (Auth::guard($guard)->check()) {
	        //return redirect('person/home');
	        return redirect('person/inicio');
	    }

	    return $next($request);
	}
}