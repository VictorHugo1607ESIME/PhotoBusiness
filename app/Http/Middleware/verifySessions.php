<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
// 396x594
// 683x1024
class verifySessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = new User();
        $user->verify_sessions();
        if (session('logout')) {
            return redirect(URL('/logout'));

            ///cerrar sesion o enviar a pagiena para indicar que se cerrara la sesion
        }
        return $next($request);
    }
}
