<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];


public function post_image()
{
    return $this->hasMany(PostImage::class);
}

public function user()
{
    return $this->belongsTo(User::class);

}

}