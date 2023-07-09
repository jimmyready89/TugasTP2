<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\UserSession;

class RefreshSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $UserSession = UserSession::Refresh($request->UserSession);
            if ($UserSession == "") {
                throw new Exception("");
            }

            Cookie::queue('session-user', $UserSession, 420);
        } catch (\Throwable $th) {
            return redirect('login');
        }

        return $next($request);
    }
}
