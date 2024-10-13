<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\User\UserModel;

class TestingLoginTest extends TestCase
{
    public function test_login(): void
    {
        $user = UserModel::factory()->create();

        $password = Str::random(10);

        $user->SetPassword($password);

        $BodyRequest = [
            "username" => $user->username,
            "password" => $password
        ];

        $response = $this->postJson('/api/sign/login', $BodyRequest);
        
        $response->assertStatus(200);
    }

    public function test_login_wrong_password(): void
    {
        $user = UserModel::factory()->create();

        $password = Str::random(10);

        $user->SetPassword($password);

        $BodyRequest = [
            "username" => $user->username,
            "password" => $password . "Add"
        ];

        $response = $this->postJson('/api/sign/login', $BodyRequest);
        
        $response->assertStatus(401)
            ->assertJsonPath('message', ["Unauthorised"]);
    }

    public function test_username_not_input(): void
    {
        $user = UserModel::factory()->create();

        $password = Str::random(10);

        $user->SetPassword($password);

        $BodyRequest = [
            "username" => null,
            "password" => $password
        ];

        $response = $this->postJson('/api/sign/login', $BodyRequest);
        
        $response->assertStatus(400)
            ->assertJsonPath('message', ["username is required"]);
    }

    public function test_password_not_input(): void
    {
        $user = UserModel::factory()->create();

        $password = Str::random(10);

        $user->SetPassword($password);

        $BodyRequest = [
            "username" => $user->username,
            "password" => null
        ];

        $response = $this->postJson('/api/sign/login', $BodyRequest);
        
        $response->assertStatus(400)
            ->assertJsonPath('message', ["password is required"]);
    }
}
