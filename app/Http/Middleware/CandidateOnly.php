<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class CandidateOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if (auth()->check() && !auth()->user()->hasRole(7)) {
        	alert()->error('Kesalahan', 'Akses ditolak.');
    		return redirect()->route('home.index');
    	}
	    return $next($request);
    }
}