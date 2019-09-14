<?php

namespace App\Http\Controllers\Users;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

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
    * @return \Illuminate\Http\JsonResponse
    * @throws \Illuminate\Validation\ValidationException
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
      return respond(400,'error',[
             'error' => 'Email does not exist.'
         ]);
      }
      // Verify the password and generate the token
      if (Hash::check($this->request->input('password'), $user->password)) {
      return respond(200,'success',[
            'user' => $user,
            'token' => $this->jwt($user)
         ]);
      }
      // Bad Request response
      return respond(400,'error',[
             'error' => 'Email or password is not correct.'
         ]);
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
