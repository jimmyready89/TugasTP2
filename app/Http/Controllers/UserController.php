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
        $user = auth()->user();
      
        return response()->json(['user' => $user], 200);
        // $Users = UserModel::select([
        //     "username",
        //     "active"
        // ])->get();

        // return $this->sendResponse([
        //     'users' => $Users
        // ]);
    }
}
