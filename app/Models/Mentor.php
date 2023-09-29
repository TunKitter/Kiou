<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Mentor extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'username',
        'image',
        'image.avatar',
        'image.front_card',
        'image.back_card',
        'profession',
        'contact',
        'description',
        'payment',
    ];
    protected $attributes = [
        'image' => [
            'avatar' => 'avatar.png',
            'front_card' => '',
            'back_card' => '',
        ],
    ];
}
