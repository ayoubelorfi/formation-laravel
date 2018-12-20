<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Post;

class AddController extends Controller
{
    public function get()
    {
        return view("post/add");
    }

    public function post(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->input("title");
        $post->content = $request->input("content");
        $post->save();

        return redirect()->route("post_list");
    }
}
