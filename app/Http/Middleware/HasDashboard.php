<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class HasDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    	if (auth()->check() && auth()->user()->hasRole(2) && !auth()->user()->hasRole(1)) {
            alert()->info('Mohon Menunggu', 'Hak akses Anda sedang disesuaikan.')->autoClose(false);
			return redirect()->route('home.lounge');
    	} else if (auth()->check() && auth()->user()->hasRole(7) && !auth()->user()->hasRole(1)) {
            alert()->error('Kesalahan', 'Akses ditolak.');
            return redirect()->route('home.index');
        } else if (auth()->check() && auth()->user()->hasRole(1)) {
            return redirect()->route('master.index');
        } else {
            return $next($request);
        }
        return abort(404, 'DUH, INI KENAPA?!');
    }
}
