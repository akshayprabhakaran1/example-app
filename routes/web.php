<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('ping', function () {
   $mailchimp = new \MailchimpMarketing\ApiClient();

   $mailchimp->setConfig([
       'apiKey' => config('services.mailchimp.key'),
       'server' => 'us14'
   ]);

   $response = $mailchimp->lists->addListMember('09de25205f', [
       'email_address' => 'ambadiakshay25@gmail.com',
       'status' => 'subscribed'
   ]);
   dd($response);
});

Route::get('/', [PostController::class, 'index'])->name("home");

// where is used to add constants to the url coming
//! route model binding
// the wildcard name must be same as we pass to the PostController class
//                  |-----------------------|
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post("posts/{post:slug}/comments", [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

// with the existing models to avoid the n+1 problem
// we can use the load() method as with()
// load(['category', 'author'])
