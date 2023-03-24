<?php

namespace App\Http\Controllers;

use Http;

class TestController extends Controller
{
    //

    public function index()
    {
        // Make a call to the API
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        return $response->json();
    }

}