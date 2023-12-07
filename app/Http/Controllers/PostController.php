<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    // to log sql query's with there corresponding binding values
    // DB::listen(function ($query) {
    // log in storage->log->laravel
    // Log::info($query -> sql, $query -> bindings);
    // });

    // latest will add order by constants
    // with the use of with() we can solve the n+1 problem
    // with(["category", "author"])
    // we can pass it separately or as a single array
    // also without() method to avoid the grabbing of relations

    // always stick to the restfull names for your functions in controller
    // like index, show, create, store, edit, update, destroy

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        //! the variable pass to filter() will goto the
        //! query scope in the Eloquent model
        // posts.index is a naming convention,
        // so we add the blade components in the posts folder
        // and name the show and index

        //! with query string will paginate with the query we are currently in
        return view('posts.index', [
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        //! Find a post by its slug and pass it to a view called 'post'
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function create(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('posts.create');
    }

    public function store(): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {

        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
//        dd(request()->file('thumbnail')->store('thumbnails'));

        Post::create($attributes);

        return redirect('/');
    }
}
