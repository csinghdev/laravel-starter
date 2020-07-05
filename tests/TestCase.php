<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    protected function setUp() : void {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');

        $this->withoutExceptionHandling();
    }
}
