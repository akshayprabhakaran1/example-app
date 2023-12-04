<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PostController::class, 'index'])->name("home");

// where is used to add constaints to the url comming
//! route model binding
// the wildcard name must be same as we pass to the PostController class
//                  |-----------------------|
Route::get('posts/{post:slug}', [PostController::class, 'show']);

// with the existing models to avoid the n+1 problem
// we can use the load() method as with()
// load(['category', 'author'])