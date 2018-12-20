<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get("/contact")
    ->uses("ContactController@form")
    ->name("contact")
;

Route::post("/contact")
    ->uses("ContactController@send")
    ->name("send")
;

Route::get("/")
    ->uses("Post\ListController")
    ->name("post_list")
;

Route::get("/posts/{post}")
    ->uses("Post\ShowController")
    ->name("post_show")
    ->where("post", "[0-9]+")
;

Route::get("/posts/{post}/update")
    ->uses("Post\UpdateController@get")
    ->name("post_update")
    ->where("post", "[0-9]+")
;

Route::post("/posts/{post}/update")
    ->uses("Post\UpdateController@post")
    ->name("post_update_post")
    ->where("post", "[0-9]+")
;

Route::get("/posts/{post}/delete")
    ->uses("Post\DeleteController")
    ->name("post_delete")
    ->where("post", "[0-9]+")
;

Route::get("/posts/add")
    ->uses("Post\AddController@get")
    ->name("post_add")
;

Route::post("/posts/add")
    ->uses("Post\AddController@post")
    ->name("post_add_post")
;

Route::post("/posts/{post}/comment")
    ->uses("Post\CommentController")
    ->name("post_comment")
    ->where("post", "[0-9]+")
;