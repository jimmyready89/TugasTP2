<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\UserSession;
use Illuminate\Support\Facades\Auth;

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

            $UserSessionJWT = UserSession::JWTContent($SessionUserCookie);
            if ($UserSessionJWT == []) {
                throw new Exception("");
            }

            $request->merge([
                "UserSessionJWT" => $UserSessionJWT,
            ]);

            Auth::loginUsingId($UserSessionJWT["user"]);
        } catch (\Throwable $th) {
            Auth::logout();
 
            $request->session()->invalidate();
        
            $request->session()->regenerateToken();

            return redirect('login');
        }

        return $next($request);
    }
}
