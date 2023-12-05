<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//! elugate model
class Post extends Model
{
    use HasFactory;


    // it tell that when ever there is a request to post always 
    // include the category and author 
    // there by eleminating the n+1 problem
    protected $with = ['category', 'author'];

    //! fillable, guarded property is used to avoid mass assignment vulnarability

    //guarded will consided the id that cant be mass included
    protected $guarded = ['id'];
    //! if we make guarded property to a empty array we can disable the mass assignment
    //fillable will consider the title can be mass included
    // protected $fillable = ['title', 'excerpt', 'body'];

    //! query scope
    // Post::newQuery()->filter()
    // first argument is passed by the laravel 
    public function scopeFilter($query, array $filters)
    {
        //! only after the get() the query will execute

        //! when() is a builder function
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn($query) => 
                $query->where('title', 'like', '%' . $search . '%')
                ->and
            )
        );


        $query->when(
            $filters['category'] ?? false,
            fn($query, $category) =>
            $query->whereHas('category', fn($query) => $query->where('slug', $category))
        );

        $query->when(
            $filters['author'] ?? false,
            fn($query, $author) =>
            $query->whereHas('author', fn($query) => $query->where('username', $author))
        );

    }

    // each funtion we type here is a relationship to the Post
    public function category()
    {

        // relationship offered by laravel
        // hasOne, hasMany, belongTo, belongToMany
        return $this->belongsTo(Category::class);
    }

    // assume the forign key will be assumed as author_id
    public function author()
    {

        // because a post have relation to a single user
        // we can pass name of the forgin key in the table 
        // to override the assumption  as author_id
        return $this->belongsTo(User::class, 'user_id');
    }

}
