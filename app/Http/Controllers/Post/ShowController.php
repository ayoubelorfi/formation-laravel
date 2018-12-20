<?php

namespace App\Http\Controllers\Post;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class ShowController
 * @package App\Http\Controllers\Post
 */
class ShowController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Post $post)
    {
        return view("post/show")->with("post", $post);
    }
}