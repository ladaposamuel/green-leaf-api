<?php

namespace App\Http\Controllers\Users;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
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
   private $request;

   /**
    * Create a new controller instance.
    *
    * @param \Illuminate\Http\Request $request
    * @return void
    */
   public function __construct(Request $request)
   {
      $this->request = $request;
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
   public function login()
   {
      $this->validate($this->request, [
         'email' => 'required|email',
         'password' => 'required'
      ]);
      // Find the user by email
      $user = User::where('email', $this->request->input('email'))->first();
      if (!$user) {
         return respond('error', [
            'error' => 'Email does not exist.'
         ], 400);
      }
      // Verify the password and generate the token
      if (Hash::check($this->request->input('password'), $user->password)) {
         return respond('success', [
            'user' => $user,
            'token' => $this->jwt($user)
         ]);
      }
      // Bad Request response
      return respond('error', [
         'error' => 'Email or password is not correct.'
      ], 400);
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
            'token' => $this->jwt($user)
         ]);
      } catch (\Exception $error) {
         return respond('error', [
            'error' => $error
         ], 422);
      }

   }

   protected function jwt(User $user)
   {
      $payload = [
         'iss' => 'lumen-jwt', // Issuer of the token
         'sub' => $user->id, // Subject of the token
         'iat' => time(), // Time when JWT was issued.
         'exp' => time() + 60 * 60 // Expiration time
      ];
      return JWT::encode($payload, env('JWT_SECRET'));
   }
}
