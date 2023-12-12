<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;
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
    protected $attributes = [
        'allow_buy_seperate' => false,
        'action' => [],
        'point' => [],
    ];

    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
