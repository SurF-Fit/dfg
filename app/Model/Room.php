<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'Name',
        'Type_of_room',
        'subdivision'
    ];

    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class, 'subdivision', 'id');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'room', 'id');
    }
}