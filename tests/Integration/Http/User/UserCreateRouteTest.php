<?php

namespace Tests\Integration\Http\User;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Integration\AbstractIntegrationTestCase as TestCase;

final class UserCreateRouteTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    public function testUserCreate(): void
    {
        $user = [
            'fullName'        => $this->faker()->name,
            'email'       => $this->faker()->unique()->email(),
            'country'     => $this->faker()->country(),
            'phoneNumber' => '+37455610614',
        ];

        $this
            ->json('POST', 'authUser/create', $user)
            ->assertCreated();

        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('user_countries', 1);
        $this->assertDatabaseCount('user_phones', 1);
    }
}
