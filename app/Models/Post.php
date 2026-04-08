<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Allow these fields to be mass assigned via Post::create().
    protected $fillable = ['title', 'body', 'user_id'];

    // A post belongs to a single user.
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
