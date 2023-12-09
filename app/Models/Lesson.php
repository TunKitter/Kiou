<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'chapter.0',
        'chapter.1',
        'chapter.2',
        'subtitle',
        'course_id',
        'allow_buy_seperate',
        'path',
    ];
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
