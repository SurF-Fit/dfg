<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'Surname',
        'Name',
        'SurnameSecond',
        'Date_of_birth',
        'subdivision',
        'image_path',
    ];

    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class, 'subdivision', 'id');
    }

    public function phones()
    {
        return $this->hasMany(Phone::class, 'subscriber', 'id');
    }
}