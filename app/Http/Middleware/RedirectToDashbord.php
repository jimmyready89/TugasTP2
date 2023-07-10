<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\UserSession;

class RedirectToDashbord
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $SessionUserCookie = $request->cookie("session-user");
            if ($SessionUserCookie == "") {
                throw new Exception("");
            }
 
            $UserSessionJWT = UserSession::JWTContent($SessionUserCookie);
            if ($UserSessionJWT != []) {
                return redirect('/');
            }
        } catch (\Throwable $th) {
        }

        return $next($request);
    }
}
