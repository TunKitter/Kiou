<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'parent_profession',
    ];

    protected $attributes = [
        'parent_profession' => [],
    ];
}
