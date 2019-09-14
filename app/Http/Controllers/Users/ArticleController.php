<?php

namespace App\Http\Controllers\Users;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * @group Articles Route
 *
 * Auth route
 */
class ArticleController extends Controller
{
   protected $user;

   public function __construct()
   {
      $this->user = Auth::user();
   }


   /**
    * New Article
    *
    * @bodyParam title title required The title of the article.
    * @bodyParam message string required The message of the article.
    *
    * @response {
    *  "status" : "success",
    *  "data" : "Article Posted successfully"
    * }
    *
    * @response 422 {
    *  "status" : "error",
    *  "data" : "Validation errors"
    * }
    *
    */
   public function new(Request $request)
   {
      $validator = \Validator::make($request->all(), [
         'title' => 'required',
         'message' => 'required'
      ]);

      if ($validator->fails()) {
         return respond('error', $validator->errors(), 422);
      }

      $article = new Article();
      $article->title = $request->input('title');
      $article->message = $request->input('message');
      $article->user_id = Auth::id();
      $article->save();

      if ($article) {
         return respond('success', 'Article posted successfully');
      } else {
         return respond('error', 'An error occurred please try again', 400);
      }
   }

   /**
    * List all Articles
    *
    *
    * @response {
    *  "status" : "success",
    *  "data" : []
    * }
    *
    *
    */
   public function list()
   {
      $articles = Article::all();
      return respond('success', $articles);
   }

   /**
    * Get an Article
    *
    *
    * @response {
    *  "status" : "success",
    *  "data" : {}
    * }
    *
    * @response 404 {
    *  "status" : "error",
    *  "error" : "Article ID not found"
    * }
    *
    */
   public function view($id)
   {
      try {
         $articles = [];
         if ($id) {
            $articles = Article::findOrFail($id);
         }
         return respond('success', $articles);
      } catch (\Exception $e) {
         return respond('error', 'Article ID not found', 404);
      }

   }
}
