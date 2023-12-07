<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    public function post(): BelongsTo
    { // laravel thinks that the foreign key will be post_id
        return $this->belongsTo(Post::class);
    }

    public function author(): BelongsTo
    { // laravel will think author_id, we need to explicitly give foreign key user_id
        return $this->belongsTo(User::class, "user_id");
    }
}
