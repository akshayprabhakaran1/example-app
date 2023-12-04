<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name("home");

// where is used to add constaints to the url comming
//! route model binding
// the wildcard name must be same as we pass to the PostController class
//                  |-----------------------|
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// with the existing models to avoid the n+1 problem
// we can use the load() method as with()
// load(['category', 'author'])

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'posts' => $author->posts,
        "categories" => Category::all()
    ]);
});