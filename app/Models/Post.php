<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\PostCategory;
class Post extends Model
{
    public function category()
    {
        return $this->belongsTo(PostCategory::class);
        
    }
}
