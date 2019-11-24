<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['sentence', 'book_title', 'book_author', 'comment','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
