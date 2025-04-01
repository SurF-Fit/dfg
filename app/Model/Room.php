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
        'subdivision_id'
    ];

    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class);
    }

    public function attachedUsers()
    {
        return $this->hasMany(AttachedUser::class);
    }
}