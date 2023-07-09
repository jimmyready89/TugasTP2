<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\UserSession;

class CheckSession
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

            $UserSession = UserSession::JWTContent($SessionUserCookie);
            if ($UserSession == []) {
                throw new Exception("");
            }

            $request->merge([
                "UserSession" => $UserSession
            ]);
        } catch (\Throwable $th) {
            return redirect('login');
        }

        return $next($request);
    }
}
