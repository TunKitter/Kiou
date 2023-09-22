<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'name',
        'username',
        'phone',
        'password',
        'email',
        'images',
    ];

}