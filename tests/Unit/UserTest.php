<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User\UserModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_create(): void
    {
        $this->artisan('migrate', [
            "--path" => "database/migrations/*"
        ]);

        $user = UserModel::factory()->create();
        $this->assertTrue(true);
    }
}
