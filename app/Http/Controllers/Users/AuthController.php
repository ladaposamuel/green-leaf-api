<?php

namespace App\Http\Controllers\Users;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


/**
 * @group Authentication Route
 *
 * Auth route
 */
class AuthController extends Controller
{

   /**
    * The request instance.
    *
    * @var \Illuminate\Http\Request
    */
   protected $jwt;

   /**
    * Create a new controller instance.
    *
    * @param \Illuminate\Http\Request $request
    * @return void
    */

   public function __construct(JWTAuth $jwt)
   {
      $this->jwt = $jwt;
   }


   /**
    * Login Route
    *
    * @bodyParam email email required User Email.
    * @bodyParam password string required User Password.
    *
    * @response {
    *  "status" : "success",
    *  "data" : {"user" : {}, "token": ""}
    * }
    *
    */
   public function login(Request $request)
   {

      $validator = \Validator::make($request->all(), [
         'email' => 'required',
         'password' => 'required'
      ]);

      if ($validator->fails()) {
         return respond('error', $validator->errors(), 422);
      }


      try {

         if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
            return respond('error', 'User not found', 400);
         }

      } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

         return respond('error', 'Token Expired', 500);

      } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

         return respond('error', 'Token Invalid', 500);

      } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

         return respond('error', 'Token Not specified', 500);

      }

      return respond('success', [
         'user' => $request->user(),
         'token' => $token
      ]);
   }

   /**
    * Register Route
    *
    * @bodyParam name string required User Name.
    * @bodyParam email email required User Email
    * @bodyParam password string required User Password.
    *
    * @response {
    *  "status" : "success",
    *  "data" : {"user" : {}, "token": ""}
    * }
    *
    */
   public function register(Request $request)
   {

      $validator = \Validator::make($request->all(), [
         'name' => 'required',
         'email' => 'required|email|unique:users',
         'password' => 'required'
      ]);

      if ($validator->fails()) {
         return respond('error', $validator->errors(), 422);
      }
      try {
         $email = $request->input('email');
         $name = $request->input('name');
         $password = app('hash')->make($request->input('password'));
         $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
         ]);
         return respond('success', [
            'user' => $user,
            'token' => \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user)
         ]);
      } catch (\Exception $error) {
         return respond('error', [
            'error' => $error
         ], 422);
      }

   }

}
