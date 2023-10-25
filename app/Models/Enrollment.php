<?php

namespace App\Models;

use App\Models\Course;
use MongoDB\Laravel\Eloquent\Model;

class Enrollment extends Model
{

    protected $fillable = [
        "course_id",
        "lesson_id",
        "user_id",
        "price",

    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
