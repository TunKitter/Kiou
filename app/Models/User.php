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
        'name',
        'username',
        'image',
        'phone',
        'profession',
        'email',
        'password',
        'avatar',
        'auth',
    ];
    protected $attributes = [
        'phone' => '',
        'username' => '',
        'image' => [],
        'profession' => [],
        'role' => ['650ba6fdf6e2892bb7012082'],
    ];

    public function mentor()
    {
    return $this->hasOne(Mentor::class, 'user_id');
    }


}
