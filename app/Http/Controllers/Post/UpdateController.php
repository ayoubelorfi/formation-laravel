<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Http\Controllers\Controller;

/**
 * Class UpdateController
 * @package App\Http\Controllers\Post
 */
class UpdateController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get(Post $post)
    {
        return view("post/update")->with("post", $post);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Post $post, PostRequest $request)
    {
        $post->title = $request->input("title");
        $post->content = $request->input("content");
        $post->save();

        return redirect()->route("post_list");
    }
}
