<?php
namespace App\Models;

use App\Models\Course;
use MongoDB\Laravel\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = [
        'name',
        'ip',
        'user_id',
        'username',
        'image',
        'image.avatar',
        'image.front_card',
        'image.user_face',
        'image.back_card',
        'profession',
        'contact',
        'description',
        'payment',
    ];
    protected $attributes = [
        'image' => [
            'avatar' => 'avatar.jpg',
            'front_card' => '',
            'back_card' => '',
            'user_face' => '',
        ],
    ];
    public function course()
    {
        return $this->hasMany(Course::class);
    }
    public function profession()
    {
        return $this->hasMany(Profession::class);
        // return $this->hasOne(Mentor::class, 'mentor_id');
    }
}
