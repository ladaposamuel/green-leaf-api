<?php

class UserAuthCest
{
    public function _before(ApiTester $I)
    { }

    public function userShouldBeAbleToLogin(ApiTester $I)
    {
        $I->wantToTest('User should be able to login');
        // create user data using factory
        factory(\App\User::class)->create([
            'email' => 'didik@gmail.com',
            'password' => app('hash')->make('password'),
        ]);
        // send credential data
        $I->sendPOST('/auth/login', ['email' => 'didik@gmail.com', 'password' => 'password']);
        // login success
        $I->seeResponseCodeIs(200);
        // check if returned user data is contain expected email
        $I->seeResponseContainsJson(['email' => 'didik@gmail.com']);
    }

    public function testLoginFail(ApiTester $I)
    {
        $I->wantToTest('User should see error 400 on wrong email');
        // create user data using factory
        factory(\App\User::class)->create([
            'email' => 'didikx@gmail.com',
            'password' => app('hash')->make('password'),
        ]);
        // send credential data
        $I->sendPOST('/auth/login', ['email' => 'didik@gmail.com', 'password' => 'password']);
        // login success
        $I->seeResponseCodeIs(400);
        // check if returned user data is contain expected email
        $I->seeResponseContainsJson(['status' => 'error']);
    }
}
