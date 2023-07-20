<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User\UserModel;
use App\Models\User\UserSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function Index(): view {
        return view('Login.Login');
    }

    public function Login(LoginRequest $Request): RedirectResponse {
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
            return redirect('login')->withErrors([
                "validator" => "Username or password invalid"
            ]);
        }

        try {
            $SessionUser = UserSession::Create($UserModel);
        } catch (\Throwable $th) {
            Auth::logout();
 
            $Request->session()->invalidate();
        
            $Request->session()->regenerateToken();

            return redirect('login')->withErrors([
                "validator" => "Error login please contact support"
            ]);
        }

        return redirect("/")->cookie('session-user', $SessionUser, 420);
    }
}
