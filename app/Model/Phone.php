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

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room', 'id');
    }
}