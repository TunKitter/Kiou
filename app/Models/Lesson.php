<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [];
    protected $attributes = [];

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
