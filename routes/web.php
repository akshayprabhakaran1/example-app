<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    // to log sql querys with there corresponding binding values
    // DB::listen(function ($query) { 
        // log in storage->log->laravel
        // Log::info($query -> sql, $query -> bindings);
    // });

    // latest will add order by constaints
    // with the use of with() we can solve the n+1 problem
    // with(["category", "author"])
    // we can pass it seperatily or as a single array
    // also without() method to avoid the grabing of relations

    return view('posts', [
        "posts" => Post::latest() -> get()
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

// with the existing models to avoid the n+1 problem
// we can use the load() method as with()
// load(['category', 'author'])

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category -> posts
    ]);
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author -> posts
    ]);
});