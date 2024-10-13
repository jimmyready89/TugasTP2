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

        $this->assertTrue(self::$user->userid !== null);
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

    public function test_validate_password_input_wrong_password(): void
    {
        $ValidatePassword = self::$user->ValidatePassword(self::$password . "_OtherInput");

        $this->assertFalse($ValidatePassword);
    }

    public function test_make_user_inactive(): void
    {
        self::$user->Inactive();

        $this->assertTrue(self::$user->active == 0);
    }

    public function test_validate_password_on_user_inactive(): void
    {
        $ValidatePassword = self::$user->ValidatePassword(self::$password);

        $this->assertFalse($ValidatePassword);
    }
}
