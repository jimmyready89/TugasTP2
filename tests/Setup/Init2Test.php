<?php

namespace Tests\Unit;

use Tests\TestCase;

class Init2Test extends TestCase
{
    public function test_init_data(): void
    {
        $this->artisan('migrate');
    
        $this->artisan('passport:client', [
           "--name" => 'Laravel Personal Access Client',
            "--personal" => null,
            "--no-interaction" => null
        ]);

        $this->artisan('passport:keys');

        $this->assertTrue(true);
    }
}
