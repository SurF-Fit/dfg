<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subscribers extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'Surname',
        'Name',
        'SurnameSecond',
        'Date_of_birth',
        'subdivision'
    ];

    public function subdivision()
    {
        return $this->belongsTo(Subdivision::class, 'subdivision', 'id');
    }
}