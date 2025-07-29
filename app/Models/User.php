<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'username'; // Primary key: username
    public $incrementing = false; // Tidak auto-increment
    protected $keyType = 'string'; // Tipe data string

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function guru()
    {
        return $this->hasOne(Guru::class, 'username_user', 'username');
    }

    public function murid()
    {
        return $this->hasOne(Murid::class, 'username_user', 'username');
    }
}