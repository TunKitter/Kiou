<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;

class PostCategory extends Model
{
    protected $collection = 'post_categories';
    protected $fillable = [
        'name',
        'slug',
    ];
}

