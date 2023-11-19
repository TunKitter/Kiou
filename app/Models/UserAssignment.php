<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class UserAssignment extends Model
{
    public $collection = 'user_assignments';
    protected $fillable = [
        'user_id',
        'assignment_id',
        'state',
        'code_path',
    ];
    protected $attributes = [];

}
