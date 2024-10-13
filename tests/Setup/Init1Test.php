<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Init1Test extends TestCase
{
    use RefreshDatabase;

    public function test_refresh_database(): void
    {
        $this->assertTrue(true);
    }
}
