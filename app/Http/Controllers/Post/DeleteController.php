<?php

namespace App\Http\Controllers\Post;

use App\Post;
use App\Http\Controllers\Controller;

/**
 * Class DeleteController
 * @package App\Http\Controllers\Post
 */
class DeleteController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function __invoke(Post $post)
    {
        $post->delete();

        return redirect()->route("post_list");
    }
}
