<?php

class UserAuthCest
{
   public function _before(ApiTester $I)
   {
   }

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

   public function testRegisterSuccess(ApiTester $I)
   {
      $I->wantToTest('User should be able to create a new account');
      // send credential data
      $I->sendPOST('/auth/register', ['name' => 'James', 'email' => 'james@gmail.com', 'password' => 'password']);
      // login success
      $I->seeResponseCodeIs(200);
      // check if returned user data is contain expected email
      $I->seeResponseContainsJson(['name' => 'James', 'email' => 'james@gmail.com']);
   }

   public function testRegisterFail(ApiTester $I)
   {
      $I->wantToTest('User should get error on dupicate email');
      factory(\App\User::class)->create([
         'email' => 'samuel@gmail.com',
         'password' => app('hash')->make('password'),
      ]);
      // send credential data
      $I->sendPOST('/auth/register', ['name' => 'samuel', 'email' => 'samuel@gmail.com', 'password' => 'password']);
      // login success
      $I->seeResponseCodeIs(422);
   }

   public function testRegisterFailNoName(ApiTester $I)
   {
      $I->wantToTest('User should get error on no name provided');
      // send credential data
      $I->sendPOST('/auth/register', ['name' => '', 'email' => 'samuel@gmail.com', 'password' => 'password']);
      // login success
      $I->seeResponseCodeIs(422);
   }

   public function testRegisterFailNoEMail(ApiTester $I)
   {
      $I->wantToTest('User should get error on no email provided');
      // send credential data
      $I->sendPOST('/auth/register', ['name' => 'Samuel', 'email' => '', 'password' => 'password']);
      // login success
      $I->seeResponseCodeIs(422);
   }

   public function testRegisterFailNoPassword(ApiTester $I)
   {
      $I->wantToTest('User should get error on no email provided');
      // send credential data
      $I->sendPOST('/auth/register', ['name' => 'Samuel', 'email' => 'sam@mail.io', 'password' => '']);
      // login success
      $I->seeResponseCodeIs(422);
   }


}
