<?php

namespace App\Http\Controllers;

use App\Models\Post;

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
        // posts.index is a naming convention
        // so we add the blade components in the posts folder
        // and name the show and index

        //! with query string will paginate with the query we are currently in
        return view('posts.index', [
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        //! Find a post by its slug and pass it to a view called 'post'
        return view('posts.show', [
            'post' => $post
        ]);
    }

    // always stick to the restfull names for your functions in controller
    // like index, show, create, store, edit, update, destroy
}
