<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'course_id',
        'lesson_id',
        'user_id',
    ];
    protected $attributes = [];

}
