<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use App\Models\PostCategory;
class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'content'
    ];
    public function category()
    {
        return $this->belongsTo(PostCategory::class);
        
    }
}