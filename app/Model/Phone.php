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
        'subscriber ',
        'room'
    ];

    // Связь с абонентом
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber', 'id');
    }

    // Связь с комнатой (если нужно сохранить)
    public function room()
    {
        return $this->belongsTo(Room::class, 'room', 'id');
    }
}