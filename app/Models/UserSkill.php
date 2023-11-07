<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserSkill extends Model
{
    public $collection = 'user_skills';
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'infor',
    ];
    protected $attributes = [];

}
