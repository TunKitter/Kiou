<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class User extends Model
{
    protected $collection = 'users';
}
