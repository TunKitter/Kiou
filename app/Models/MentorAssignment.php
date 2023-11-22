<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class MentorAssignment extends Model
{
    public $collection = 'mentor_assignments';
    protected $fillable = [];
    protected $attributes = [];
}
