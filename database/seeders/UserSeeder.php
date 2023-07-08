<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\UserModel;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        UserModel::create([
            'username' => Str::random(5),
            'password' => Str::random(7),
            'salt' => Str::random(7),
            'usercreate_id' => 1,
            'userupdate_id' => 1,
            'active' => 1,
        ]);
    }
}
