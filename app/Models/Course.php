<?php
namespace App\Models;

use App\Models\Chapter;
use App\Models\Level;
use App\Models\Mentor;
use App\Models\Enrollment;
use MongoDB\Laravel\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [];
    protected $attributes = [];
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
        // return $this->hasOne(Mentor::class, 'mentor_id');
    }
    public function chapter()
    {
        return $this->hasOne(Chapter::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function carts()
    {
        return $this->hasMany(Enrollment::class);
    }

}
