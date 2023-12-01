<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    //! fillable, guarded property is used to avoid mass assignment vulnarability
    
    //guarded will consided the id that cant be mass included
    protected $guarded = ['id'];
    //! if we make guarded property to a empty array we can disable the mass assignment
    //fillable will consider the title can be mass included
    // protected $fillable = ['title', 'excerpt', 'body'];

}
