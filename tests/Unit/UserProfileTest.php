<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User\UserProfileModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_userprofile_create(): void
    {
        $this->artisan('migrate', [
            "--path" => "database/migrations/*"
        ]);

        $userprofile = UserProfileModel::factory()->create();
        $this->assertTrue(true);
    }
}
