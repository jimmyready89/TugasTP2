<?php

namespace App\Http\Controllers;

use App\Models\User\UserModel;
use App\Models\User\UserSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Http\Requests\User\{
    UpdateRequest,
    CreateRequest
};

class UserController extends Controller
{
    public function Search(): JsonResponse {
        $Users = UserModel::select([
            "id",
            "username",
            "active"
        ])->get();

        return $this->sendResponse([
            'user_list' => $Users
        ]);
    }

    public function Detail(int $Id): JsonResponse {
        $UserData = [];
        
        try {
            $User = UserModel::find($Id);
            if ($User === null) {
                throw new \Exception('User Id Invalid');
            }
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        $UserData["username"] = $User->username;

        $UserProfile = $User->Profile;
        $UserData["realname"] = $UserProfile->real_name ?? '';
        $UserData["email"] = $UserProfile->email ?? '';
        
        return $this->sendResponse($UserData);
    }

    public function Update(UpdateRequest $Request, int $Id): JsonResponse {
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

    public function Create(CreateRequest $Request): JsonResponse {
        $UserName = $Request->username;
        $password = $Request->password;
        $RealName = $Request->real_name;
        $Email = $Request->email;
        $UserId = auth()->id();

        try {
            $UserNameExisting = UserModel::where([
                "username" => $UserName
            ])->exists();

            if ($UserNameExisting) {
                throw new \Exception("Username has been used");
            }
        } catch (\Exception $e) {
            $Message[] = $e->getMessage();

            return $this->sendError(message: $Message);
        }

        $User = UserModel::create([
            'username' => $UserName,
            'usercreate_id' => $UserId,
            'userupdate_id' => $UserId
        ]);

        $User->SetPassword($password);

        $User->Profile()->Create([
            "real_name" => $RealName,
            "email" => $Email
        ]);

        $Message[] = "Create User Success";

        return $this->sendResponse(result:[
            "user_id" => $User->id
        ], message: $Message);
    }
}
