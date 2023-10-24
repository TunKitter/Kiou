<?php

namespace App\Models;


use MongoDB\Laravel\Eloquent\Model;
use App\Models\Course;

class Enrollment extends Model
{


    protected $fillable = [
       "course_id",
       "user_id",
       "price"

    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
