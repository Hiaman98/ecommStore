<?php

namespace App;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;
    protected $guard = "admin";

    protected $fillable = [
        "name", "email", "password"
    ];

    protected $hidden = [
        "password", "remember_token"
    ];
}
