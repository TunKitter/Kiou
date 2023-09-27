<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Mentor extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'user_id',
        'username',
        'image',
        'contact',
        'profession',
        'description',
        'payment',
        'role'
    ];

}
