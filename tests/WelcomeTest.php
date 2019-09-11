<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class WelcomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testWelcomeMessage()
    {
        $this->json('GET', route('index'))
            ->seeStatusCode(200)
            ->seeJson(['status' => 'success', 'data' => ['message' => 'Welcome to Grean leaf Article API V1 endpoint']]);
    }
}