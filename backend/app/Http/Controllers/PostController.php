<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
     public function test(){
        return response()->json('Hello MFA ');
    }
}
