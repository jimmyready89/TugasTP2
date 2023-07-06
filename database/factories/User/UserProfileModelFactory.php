<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User\UserProfileModel;

class UserProfileModelFactory extends Factory
{
    protected $model = UserProfileModel::class;

    public function definition(): array
    {
        return [
            "real_name" => fake()->name(),
            "email" => fake()->email()
        ];
    }
}
