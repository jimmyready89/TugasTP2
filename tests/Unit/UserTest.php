<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User\UserModel;
use App\Models\User\UserProfileModel;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    protected static $user;
    protected static $password;

    public function test_init_database(): void {
        $this->artisan('migrate', [
            "--path" => "database/migrations/User"
        ])->assertSuccessful();
    }

    public function test_user_create(): void
    {
        self::$user = UserModel::factory()->create();
        
        $this->assertTrue(self::$user->id != null);
    }

    public function test_set_profile(): void
    {
        UserProfileModel::factory()
            ->create(["userid" => self::$user->id]);

        $this->assertTrue(self::$user->Profile !== null);
    }

    public function test_set_password(): void
    {
        self::$password = Str::random(10);

        self::$user->SetPassword(self::$password);

        $this->assertTrue(self::$user->password !== "");
    }

    public function test_login(): void
    {
        $Login = self::$user->Login(self::$password);

        $this->assertTrue($Login);
    }

    public function test_login_input_wrong_password(): void
    {
        $Login = self::$user->Login(self::$password . "_OtherInput");

        $this->assertFalse($Login);
    }

    public function test_make_user_inactive(): void
    {
        self::$user->Inactive();

        $this->assertFalse(self::$user->active != 1);
    }

    public function test_login_on_user_inactive(): void
    {
        $Login = self::$user->Login(self::$password);

        $this->assertFalse($Login);
    }
}
