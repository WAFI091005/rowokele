<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah session login admin ada dan bernilai true
        if (!session()->has('is_logged_in') || !session()->get('is_logged_in')) {
            
            // Jika request datang dari AJAX (API), return JSON Unauthorized
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
            }

            // Jika akses langsung dari browser, lempar ke halaman login
            return redirect('/login2')->with('error', 'Silahkan login terlebih dahulu.');
        }

        return $next($request);
    }
}