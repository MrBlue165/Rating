<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'display_name',
        'login_name',
        'email',
        'hash_password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['hash_password'] = bcrypt($password);
    }
}
