<?php
namespace App\Models;

use App\Models\Mentor;
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
}
