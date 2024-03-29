<?php

namespace App\Http\Controllers\Users;

use App\Article;
use App\Rating;
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
    *
    *
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
    * @authenticated
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


   /**
    *
    *
    * Delete an Article
    *
    *
    * @response {
    *  "status" : "success",
    *  "data" : "Article Deleted successfully"
    * }
    *
    * @response 404 {
    *  "status" : "error",
    *  "error" : "Article ID not specified or not found"
    * }
    *
    * @response 422 {
    *  "status" : "error",
    *  "error" : "You dont have access to delete this article"
    * }
    *
    * @authenticated
    */
   public function delete($id)
   {
      try {
         $article = Article::find($id);
         if ((int)$article->user->id === Auth::id()) {
            $article->delete();
         } else {
            return respond('error', 'You dont have access to delete this article', 422);
         }
         return respond('success', 'Article Deleted successfully');
      } catch (\Exception $e) {
         return respond('error', 'Article ID not specified or not found', 404);
      }
   }


   /**
    *
    *
    * Update Article
    * @queryParam ID required The ID of the article. Example: 1
    * @bodyParam title title required The title of the article.
    * @bodyParam message string required The message of the article.
    *
    * @response {
    *  "status" : "success",
    *  "data" : {}
    * }
    *
    * @response 422 {
    *  "status" : "error",
    *  "data" : "You dont have access to update this article"
    * }
    *
    *  * @response 404 {
    *  "status" : "error",
    *  "data" : "Article ID not specified or not found"
    * }
    *
    * @authenticated
    */
   public function update(Request $request, $id)
   {
      $validator = \Validator::make($request->all(), [
         'title' => 'max:255'
      ]);

      if ($validator->fails()) {
         return respond('error', $validator->errors(), 422);
      }

      try {
         $article = Article::find($id);
         if ((int)$article->user->id === Auth::id()) {
            $article->title = $request->input('title') ?? $article->title;
            $article->message = $request->input('message') ?? $article->message;
            $article->save();
         } else {
            return respond('error', 'You dont have access to update this article', 422);
         }

         return respond('success', $article);
      } catch (\Exception $e) {
         return respond('error', 'Article ID not specified or not found', 404);
      }
   }


   /**
    *
    * Search Article
    * @queryParam q required The search query of the article. Example: hello
    *
    * @response {
    *  "status" : "success",
    *  "data" : []
    * }
    *
    * @response 422 {
    *  "status" : "error",
    *  "data" : "You need to specify a search query"
    * }
    *
    *
    */
   public function search($q)
   {
      if ($q) {
         $articles = Article::where('title', 'LIKE', '%' . $q . '%')->get();
         return respond('success', $articles);
      }
      return respond('error', 'You need to specify a search query', 422);
   }


   /**
    *
    * Rate Article
    *
    * @queryParam ID required The search query of the article. Example: hello
    *
    * @response {
    *  "status" : "success",
    *  "data" : "Ratings posted successfully"
    * }
    *
    * @response 404 {
    *  "status" : "error",
    *  "data" : "Article ID not specified or not found"
    * }
    *
    *
    */
   public function rate(Request $request, $id)
   {

      $validator = \Validator::make($request->all(), [
         'message' => 'max:255',
         'helpful' => 'required',

      ]);

      if ($validator->fails()) {
         return respond('error', $validator->errors(), 422);
      }

      try {
         Article::find($id);
         $saveRating = new Rating();
         $saveRating->helpful = $request->input('helpful');
         $saveRating->message = $request->input('message');
         $saveRating->article_id = $id;
         $saveRating->save();
         return respond('success', 'Ratings posted successfully');
      } catch (\Exception $e) {
         dd($e);
         return respond('error', 'Article ID not specified or not found', 404);
      }

   }
}
