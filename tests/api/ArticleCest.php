<?php

use App\User;

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

   public function testGetAnArticle(ApiTester $I)
   {
      $I->wantToTest('User should be able to get an article with ID');
      $I->sendGET('/articles/1');
      $I->seeResponseCodeIs(200);
      $I->seeResponseContainsJson(['status' => 'success']);
   }


   public function testGetAnArticleError(ApiTester $I)
   {
      $I->wantToTest('User should not able to get an article with wrong ID');
      $I->sendGET('/articles/900');
      $I->seeResponseCodeIs(404);
      $I->seeResponseContainsJson(['status' => 'error']);
   }

   public function testDeleteAnArticle(ApiTester $I)
   {

      $I->wantToTest('User should be able to delete an article');

      $article = factory(\App\Article::class)->create([
         'title' => 'Hello world',
         'message' => 'Lorem Ipsum',
         'user_id' => function () {
            return factory(App\User::class)->create()->id;
         },
      ]);
      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($article->user);
      $I->amBearerAuthenticated($token);

      $I->sendDELETE('/articles/' . $article->id);
      $I->seeResponseCodeIs(200);
      $I->seeResponseContainsJson(['status' => 'success']);
   }

   public function testDeleteWrongArticle(ApiTester $I)
   {

      $I->wantToTest('User should not be  able to delete other articles');

      $user = factory(\App\User::class)->create([
         'email' => 'policeman3@gmail.com',
         'password' => app('hash')->make('password'),
      ]);
      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
      $I->amBearerAuthenticated($token);

      $I->sendDELETE('/articles/2');
      $I->seeResponseCodeIs(422);
      $I->seeResponseContainsJson(['status' => 'error']);
   }

   public function test404Article(ApiTester $I)
   {

      $I->wantToTest('User should get error on wrong article ID');

      $user = factory(\App\User::class)->create([
         'email' => 'policeman3@gmail.com',
         'password' => app('hash')->make('password'),
      ]);

      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);
      $I->amBearerAuthenticated($token);

      $I->sendDELETE('/articles/9000');
      $I->seeResponseCodeIs(404);
      $I->seeResponseContainsJson(['status' => 'error']);
   }

   public function testUpdateArticleSuccess(ApiTester $I)
   {

      $I->wantToTest('User should be able to update an article');

      $article = factory(\App\Article::class)->create([
         'title' => 'Hello world',
         'message' => 'Lorem Ipsum',
         'user_id' => function () {
            return factory(App\User::class)->create()->id;
         },
      ]);
      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($article->user);
      $I->amBearerAuthenticated($token);

      $I->sendPATCH('/articles/' . $article->id, ['title' => 'New title']);
      $I->seeResponseCodeIs(200);
      $I->seeResponseContainsJson(['status' => 'success']);
   }

   public function testUpdateArticleValidation(ApiTester $I)
   {

      $I->wantToTest('User should be able to update their article only');

      $article = factory(\App\Article::class)->create([
         'title' => 'Hello world',
         'message' => 'Lorem Ipsum',
         'user_id' => function () {
            return factory(App\User::class)->create()->id;
         },
      ]);
      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($article->user);
      $I->amBearerAuthenticated($token);

      $I->sendPATCH('/articles/2');
      $I->seeResponseCodeIs(422);
      $I->seeResponseContainsJson(['status' => 'error']);
   }

   public function testUpdateArticleNotFound(ApiTester $I)
   {

      $I->wantToTest('User should be able to update their article only');

      $article = factory(\App\Article::class)->create([
         'title' => 'Hello world',
         'message' => 'Lorem Ipsum',
         'user_id' => function () {
            return factory(App\User::class)->create()->id;
         },
      ]);
      $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($article->user);
      $I->amBearerAuthenticated($token);

      $I->sendPATCH('/articles/400');
      $I->seeResponseCodeIs(404);
      $I->seeResponseContainsJson(['status' => 'error']);
   }


}
