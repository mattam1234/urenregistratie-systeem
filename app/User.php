<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categorie(){
        return $this->hasMany(Categories::class, 'werknemerNummer', 'id');
    }

    public function tasks(){
        return $this->hasMany(Tasks::class, 'werknemerNummer', 'id');
    }

    public function verlof(){
        return $this->hasMany(verlof::class, 'werknemerNummer', 'id');
    }

    public function project(){
        return $this->hasMany(Projects::class, 'werknemerNummer' ,'id');
    }

}
