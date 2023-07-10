<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User\UserSession;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function Index(): view {
        return view('Login.Login');
    }

    public function Login(LoginRequest $Request): RedirectResponse {
        $RequestValidate = $Request->validated();
        $SessionUser = "";
        $UserModel;

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
            return redirect('login')->withErrors([
                "validator" => "Username or password invalid"
            ]);
        }

        try {
            $SessionUser = UserSession::Create($UserModel);
        } catch (\Throwable $th) {
            return redirect('login')->withErrors([
                "validator" => "Error login please contact support"
            ]);
        }

        return redirect("/")->cookie('session-user', $SessionUser, 420);
    }
}
