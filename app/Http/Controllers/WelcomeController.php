<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @group Index Route
 *
 * Index route
 */
class WelcomeController extends Controller
{
    /**
     * Welcome Message
     * 
     * @response {
     *  "status" : "success",
     *  "data" : {"message" : "Welcome to Grean leaf Article API V1 endpoint"}
     * }
     */
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => ['message' => 'Welcome to Grean leaf Article API V1 endpoint']]);
    }
}