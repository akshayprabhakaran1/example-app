<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // elugate model

    // each funtion we type here is a relationship to the Post
    public function category() {

        // relationship offered by laravel
        // hasOne, hasMany, belongTo, belongToMany
        return $this->belongsTo(Category::class);
    }

    // assume the forign key will be assumed as author_id
    public function author() {

        // because a post have relation to a single user
        // we can pass name of the forgin key in the table 
        // to override the assumption  as author_id
        return $this->belongsTo(User::class, 'user_id');
    }

}
