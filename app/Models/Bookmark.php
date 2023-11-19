<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'lesson_id',
        'cards',
        'cards.0.front_card',
        'cards.1.front_card',
        'cards.2.front_card',
        'cards.3.front_card',
        'cards.4.front_card',
        'cards.5.front_card',
        'cards.6.front_card',
        'cards.7.front_card',
        'cards.8.front_card',
        'cards.9.front_card',
        'cards.10.front_card',
        'cards.0.back_card',
        'cards.1.back_card',
        'cards.2.back_card',
        'cards.3.back_card',
        'cards.4.back_card',
        'cards.5.back_card',
        'cards.6.back_card',
        'cards.7.back_card',
        'cards.8.back_card',
        'cards.9.back_card',
        'cards.10.back_card',
        'cards.0.repetition.interval',
        'cards.0.repetition.index',
        'cards.1.repetition.interval',
        'cards.1.repetition.index',
        'cards.2.repetition.interval',
        'cards.2.repetition.index',
        'cards.3.repetition.interval',
        'cards.3.repetition.index',
        'cards.4.repetition.interval',
        'cards.4.repetition.index',
        'cards.5.repetition.interval',
        'cards.5.repetition.index',
        'cards.6.repetition.interval',
        'cards.6.repetition.index',
        'cards.7.repetition.interval',
        'cards.7.repetition.index',
        'cards.8.repetition.interval',
        'cards.8.repetition.index',
        'cards.9.repetition.interval',
        'cards.9.repetition.index',
        'cards.10.repetition.interval',
        'cards.10.repetition.index',
    ];
    protected $attributes = [];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
