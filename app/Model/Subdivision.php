<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subdivision extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'Name',
        'type_of_unit',
    ];

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class, 'subdivision', 'id');
    }

}
