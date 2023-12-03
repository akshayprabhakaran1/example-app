<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts() {
        
        // relationship offered by laravel
        // hasOne, hasMany, belongTo, belongToMany
        return $this -> hasMany(Post::class);
    }
}
