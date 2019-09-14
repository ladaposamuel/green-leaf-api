<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $user =  factory(\App\User::class)->create([
            'email' => 'didik@gmail.com',
            'password' => app('hash')->make('password'),
        ]);
        $response = $this->json('POST', '/api/v1/auth/login', ['email' => 'didik@gmail.com', 'password' => 'password'])
            ->seeStatusCode(200);
    }
}