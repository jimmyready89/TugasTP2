<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User\UserModel;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition(): array
    {
        return [
            "username" => fake()->name(),
            "password" => "",
            "salt" => "",
            "usercreate_id" => 0,
            "userupdate_id" => 0
        ];
    }
}
