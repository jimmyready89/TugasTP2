<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User\UserModel;
use App\Models\User\UserProfileModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class InitTest extends TestCase
{
    use RefreshDatabase;

    public function test_refresh_database(): void
    {
        $this->assertTrue(true);
    }
}
