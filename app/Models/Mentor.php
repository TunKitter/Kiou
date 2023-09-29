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
        'profession',
        'contact',
        'description',
        'payment',
    ];
}
