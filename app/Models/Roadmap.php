<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = [
        'name',
        'content',
        'mentor_id',
        'interaction',
        'thumbnail', 0,
    ];
    protected $attributes = [
        'interaction' => [
            'like' => 0,
            'dislike' => 0,
        ],
    ];
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
