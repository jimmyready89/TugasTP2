<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User\UserModel;
use App\Models\User\UserSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignController extends Controller
{
    public function Login(LoginRequest $Request): JsonResponse {
        $RequestValidate = $Request->validated();
        $SessionUser = "";
        $UserModel = "";

        try {
            $UserModel = UserModel::where("username", $RequestValidate["username"])
                ->where("active", 1)
                ->first();

            if ($UserModel === null) {
                throw new \Exception('');
            }

            if (!$UserModel->ValidatePassword($RequestValidate["password"])) {
                throw new \Exception('');
            }
        } catch (\Throwable $th) {
            return $this->sendError(['Unauthorised'], 401);
        }

        $User = Auth::user();
        $Token =  $User->createToken('API Token')->accessToken;

        return $this->sendResponse([
            'token' => $Token
        ]);
    }
}
