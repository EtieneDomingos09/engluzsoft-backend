<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;


    protected $fillable = [
        'name',
        'email',
        'telefone',
        'password',
        'tipo',
    ];

    protected $hidden = [
        'password',
    ];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Property::class, 'favorites');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
