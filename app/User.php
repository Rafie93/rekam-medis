<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','phone','email','role','status'
    ];

    function status_display(){
        return $this->status ==1 ? 'Aktif' :'Tidak Aktif';
    }

    function role_display(){
        switch ($this->role) {
            case 1:
                return 'Admin';
                break;
            case 2:
                return 'Pendaftaran';
                break;
            case 3:
                return 'Dokter';
                break;
            case 4:
                return 'Apotek';
                break;
            default:
                return '';
                break;
        }
    }
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
