<?php

namespace App\Http\Controllers\Post;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function __invoke()
    {
        return view("post/list")->with("posts", Post::all());
    }
}
