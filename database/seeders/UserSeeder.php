<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if( UserModel::count() === 0 ) {
            $user = UserModel::create([
                'username' => Str::random(5),
                'usercreate_id' => 0,
                'userupdate_id' => 0,
            ]);

            $password = "admin12";
            $user->SetPassword($password);
        }
    }
}
