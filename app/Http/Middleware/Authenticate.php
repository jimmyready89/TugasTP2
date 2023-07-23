<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $ExpectsJson = $request->expectsJson();
        if(!$ExpectsJson) {
            $response = [
                'data' => (object)[],
                'message' => ["Header Accept must be application json"]
            ];
    
            return response()->json($response, 400);
        }

        return  null;
    }
}
