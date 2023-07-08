<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User\UserModel;


class LoginController extends Controller
{
    public function Index(): view {
        return view('Login.Login');
    }

    public function Login(LoginRequest $Request): RedirectResponse {
        $RequestValidate = $Request->validated();
        
        try {
            $UserModel = UserModel::where("username", $RequestValidate["username"])->first();
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

        return redirect("/")->cookie('session-user', 'value', 60);
    }
}
