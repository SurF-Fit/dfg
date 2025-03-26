<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'number_phone',
        'subscriber_id', // меняем room на subscriber_id
        'room' // оставляем, если нужно сохранять привязку к комнате
    ];

    // Связь с абонентом
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id', 'id');
    }

    // Связь с комнатой (если нужно сохранить)
    public function room()
    {
        return $this->belongsTo(Room::class, 'room', 'id');
    }
}