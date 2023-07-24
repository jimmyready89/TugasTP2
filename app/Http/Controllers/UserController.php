<?php

namespace App\Http\Controllers;

use App\Models\User\UserModel;
use App\Models\User\UserSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\User\{
    UpdateRequest
};

class UserController extends Controller
{
    public function Search(): JsonResponse {
        $Users = UserModel::select([
            "username",
            "active"
        ])->get();

        return $this->sendResponse([
            'users' => $Users
        ]);
    }

    public function Detail($Id): JsonResponse {
        $UserData = [];
  
        $User = UserModel::find($Id);
        $UserData["username"] = $User->username;

        $UserProfile = $User->Profile;
        $UserData["realname"] = $UserProfile->real_name ?? '';
        $UserData["email"] = $UserProfile->email ?? '';
        
        return $this->sendResponse($UserData);
    }

    public function Update(UpdateRequest $Request, $Id): JsonResponse {
        $Message = [];
  
        try {
            $User = UserModel::find($Id);
            if ($User === null) {
                throw new \Exception("Id Invalid");
            }

            $UserProfile = $User->Profile()->firstOrNew();
            $UserProfile->real_name = $Request->realname;
            $UserProfile->email = $Request->email;
            if ($UserProfile->isClean()) {
                throw new \Exception("No Change");
            }
            $UserProfile->save();

            $Message[] = "Update Success";
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }
        
        return $this->sendResponse(message: $Message);
    }

    public function Delete($Id): JsonResponse {
        $UserData = [];
  
        $User = UserModel::find($Id);
        $UserData["username"] = $User->username;

        $UserProfile = $User->Profile;
        $UserData["realname"] = $UserProfile->real_name ?? '';
        $UserData["email"] = $UserProfile->email ?? '';
        
        return $this->sendResponse($UserData);
    }
}
