<?php

namespace Tests;

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    const BASE_ROUTE = 'api/';

    protected $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Faker::create();
    }
}
