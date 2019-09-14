<?php

class ArticleCest
{
   public function _before(ApiTester $I)
   {
   }

   public function testAuth(ApiTester $I)
   {
      $I->wantToTest('User should be authenticated  to post an article');
      // create user data using factory
      factory(\App\User::class)->create([
         'email' => 'didik@gmail.com',
         'password' => app('hash')->make('password'),
      ]);
      // send credential data
      $I->sendPOST('/articles', ['title' => 'Nice title', 'message' => 'Nice message']);
      $I->seeResponseCodeIs(401);
      // check if returned user data is contain expected email
      $I->seeResponseContainsJson(['status' => 'error']);
   }


   public function testPostSuccess(ApiTester $I)
   {
      $I->wantToTest('User should be able to post an article');
      // create user data using factory

      $user = factory(\App\User::class)->create([
         'email' => 'policeman@gmail.com',
         'password' => app('hash')->make('password'),
      ]);

      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
      $I->amBearerAuthenticated($token);

      // send credential data
      $I->sendPOST('/articles', ['title' => 'Nice title', 'message' => 'Nice message']);
      // login success
      $I->seeResponseCodeIs(200);
      // check if returned user data is contain expected email
      $I->seeResponseContainsJson(['status' => 'success']);
   }

   public function testPostTitleValidation(ApiTester $I)
   {
      $I->wantToTest('User should must provide a title');
      // create user data using factory

      $user = factory(\App\User::class)->create([
         'email' => 'policeman2@gmail.com',
         'password' => app('hash')->make('password'),
      ]);

      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
      $I->amBearerAuthenticated($token);

      // send credential data
      $I->sendPOST('/articles', ['title' => '', 'message' => 'Nice message']);
      // login success
      $I->seeResponseCodeIs(422);
      // check if returned user data is contain expected email
      $I->seeResponseContainsJson(['status' => 'error']);
   }

   public function testPostMessageValidation(ApiTester $I)
   {
      $I->wantToTest('User should must provide a title');
      // create user data using factory

      $user = factory(\App\User::class)->create([
         'email' => 'policeman3@gmail.com',
         'password' => app('hash')->make('password'),
      ]);

      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
      $I->amBearerAuthenticated($token);

      // send credential data
      $I->sendPOST('/articles', ['title' => 'Title here', 'message' => '']);
      // login success
      $I->seeResponseCodeIs(422);
      // check if returned user data is contain expected email
      $I->seeResponseContainsJson(['status' => 'error']);
   }

   public function testGetAllArticles(ApiTester $I)
   {
      $I->wantToTest('User should be able to get all articles');
      $I->sendGET('/articles');
      $I->seeResponseCodeIs(200);
      $I->seeResponseContainsJson(['status' => 'success']);
   }


}
