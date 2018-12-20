<?php

namespace App\Http\Controllers\Post;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Post;

/**
 * Class CommentController
 * @package App\Http\Controllers\Post
 */
class CommentController extends Controller
{
    /**
     * @param Post $post
     * @param CommentRequest $commentRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Post $post, CommentRequest $commentRequest)
    {
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->author = $commentRequest->input("author");
        $comment->content = $commentRequest->input("content");
        $comment->save();

        return redirect()->route("post_list");
    }
}
