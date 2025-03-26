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
        'room'
    ];

    public function room()
    {
        return $this->belongsTo(room::class, 'room', 'id');
    }
}