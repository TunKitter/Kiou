<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\Post;

class PostCategory extends Model
{
    protected $collection = 'post_categories';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
