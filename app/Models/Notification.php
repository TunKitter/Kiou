<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'mentor_id',
        'content',
    ];
    protected $attributes = [];

}
