<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
    use HasFactory;

    protected $dates = ['posts'];
    protected $fillable = [
        'id',
        'title',
        'category',
        'content',
        'content_path',
        'images',
    ];
}
