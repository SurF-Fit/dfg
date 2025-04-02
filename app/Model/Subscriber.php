<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'surnamesecond',
        'date_of_birth',
        'image_path',
    ];

    public function attachedUsers()
    {
        return $this->hasMany(AttachedUser::class, 'subscriber_id', 'id');
    }

    public function phones()
    {
        return $this->hasManyThrough(
            Phone::class,
            AttachedUser::class,
            'subscriber_id',
            'id',
            'id',
            'phone_id'
        );
    }
}