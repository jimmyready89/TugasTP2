<?php

namespace App\Http\Controllers;

use App\Models\User\UserModel;
use App\Models\User\UserSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function Search() : JsonResponse {
        $Users = UserModel::select([
            "username",
            "active"
        ])->get();

        return $this->sendResponse([
            'users' => $Users
        ]);
    }

    public function Detail($Id) : JsonResponse {
        $UserData = [];
  
        $User = UserModel::find($Id);
        $UserData["username"] = $User->username;

        $UserProfile = $User->Profile;
        $UserData["realname"] = $UserProfile->real_name ?? '';
        $UserData["email"] = $UserProfile->email ?? '';
        
        return $this->sendResponse($UserData);
    }
}
