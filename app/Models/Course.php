<?php
namespace App\Models;

use App\Models\Chapter;
use App\Models\Enrollment;
use App\Models\Level;
use App\Models\Mentor;
use MongoDB\Laravel\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'complete_course_rate',
        'content_path',
        'category',
        'price',
        'view',
        'image',
        'click',
        'meta.total_chapter',
        'meta.total_lesson',
        'meta.total_time',
        'slug',
        'mentor_id',
        'total_enrollment',
        'level_id',
    ];
    protected $attributes = [
        'complete_course_rate' => 0,
        'view' => 0,
        'click' => 0,
        'total_enrollment' => 0,
    ];
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
        // return $this->hasOne(Mentor::class, 'mentor_id');
    }
    public function chapter()
    {
        return $this->hasOne(Chapter::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function carts()
    {
        return $this->hasMany(Enrollment::class);
    }

}
