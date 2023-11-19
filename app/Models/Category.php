<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'profession_id',
        'slug',
    ];
    protected $attributes = [];

}
