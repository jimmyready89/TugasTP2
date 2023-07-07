<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User\UserModel;
use App\Models\User\UserProfileModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    protected static $user;
    protected static $password;

    public function test_user_create(): void
    {
        $this->artisan('migrate', [
            "--path" => "database/migrations/User"
        ]);

        $user = UserModel::factory()->create();
        $UserProfile = UserProfileModel::factory()
            ->create(["userid" => $user->id]);

        self::$user = $user;

        $this->assertTrue(true);
    }

    public function test_set_password(): void
    {
        self::$password = Str::random(10);

        self::$user->SetPassword(self::$password);

        $this->assertTrue(self::$user->password !== "");
    }

    public function test_validate_password(): void
    {
        $ValidatePassword = self::$user->ValidatePassword(self::$password);

        $this->assertTrue($ValidatePassword);
    }
}
