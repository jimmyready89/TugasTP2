<?php

namespace App\Models\User;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\User\UserModel;
use Illuminate\Support\Facades\Crypt;

class UserSession
{
    public static function Create(UserModel $UserModel): string {
        $TimeNow = Carbon::now();
        $TimeTimeLimit = Carbon::now()->addHours(6);

        $payload = [
            'iat' => $TimeNow->timestamp,
            'nbf' => $TimeNow->timestamp,
            'exp' => $TimeTimeLimit->timestamp,
            'user' => $UserModel->id,
        ];

        $PublicKey = Storage::disk('key')->get('JWT-Private.key');

        return JWT::encode($payload, $PublicKey, 'RS256');
    }

    public static function JWTContent(string $UserSession): array {
        $JwtContent = [];

        try {
            $PrivateKey = Storage::disk('key')->get('JWT-PublicKey.key');

            $JwtContent = (array)JWT::decode($UserSession, new Key($PrivateKey, 'RS256'));
        } catch (\Throwable $th) {
        }

        return $JwtContent;
    }

    public static function Refresh(array $JwtContent): string {
        $TimeNow = Carbon::now();
        $TimeTimeLimit = Carbon::now()->addHours(6);

        $JwtContent["iat"] = $TimeNow->timestamp;
        $JwtContent["nbf"] = $TimeNow->timestamp;
        $JwtContent["exp"] = $TimeTimeLimit->timestamp;

        $PublicKey = Storage::disk('key')->get('JWT-Private.key');

        return JWT::encode($JwtContent, $PublicKey, 'RS256');
    }
}
