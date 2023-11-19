<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = [];
    protected $attributes = [];
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
