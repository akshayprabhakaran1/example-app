<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
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
    public function index()
    {

        //! the variable pass to filter() will goto the 
        //! query scope in the Elequent model
        return view('posts', [
            "posts" => Post::latest()->filter(request(['search', 'category']))->get(),
            "categories" => Category::all(),
            "currentCategory" => Category::firstWhere("slug", request("category"))
        ]);
    }

    public function show(Post $post)
    {
        //! Find a post by its slug and pass it to a view called 'post'
        return view('post', [
            'post' => $post
        ]);
    }
}
