<?php

namespace App;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Admin extends \Eloquent implements Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;

    protected $guard = "admin";

    protected $fillable = [
        "name",
        "type",
        "mobile",
        "email",
        "password",
        "image",
        "status",
        "created_at",
        "updated_at"
    ];

    protected $hidden = [
        "password", "remember_token"
    ];
}
