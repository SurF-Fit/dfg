<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachedUser extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'subscriber_id',
        'room_id',
        'phone_id',
    ];

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id', 'id');
    }
}