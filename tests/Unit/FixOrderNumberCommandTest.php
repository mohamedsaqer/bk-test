<?php

namespace Tests\Unit;

use Tests\TestCase;

class FixOrderNumberCommandTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_console_command()
    {
        $this->artisan('fix:order-number')->assertExitCode(1);
    }
}
