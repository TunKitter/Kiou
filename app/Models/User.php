<?php
namespace App\Models;

use App\Models\Mentor;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'name',
        'ip',
        'username',
        'image',
        'image.avatar',
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
        'image' => [
            'avatar' => 'avatar.jpg',
        ],
        'profession' => [],
        'role' => ['650ba6fdf6e2892bb7012082'],
        'auth' => ['google' => ''],
    ];

    public function mentor()
    {
        return $this->hasOne(Mentor::class, 'user_id');
    }
    

}
