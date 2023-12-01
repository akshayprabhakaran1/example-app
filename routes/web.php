<?php

use App\Models\Post;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('posts', [
        "posts" => Post::all()
    ]);

});

// where is used to add constaints to the url comming
//! route model binding
// the wildcard name must be same as we pass to the function
//                  |-----------------------|
Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post) -> first() behind the scene.

    //! Find a post by its slug and pass it to a view called 'post'
    return view('post', [
        'post'=> $post
    ]);

});