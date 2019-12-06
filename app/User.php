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
        'voorNaam','achterNaam', 'email', 'password','functieId','postcode','woonplaats','adress','noodNummer','telefoonNummer','geboorteDatum'
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

    public function functie()
    {
        return $this->hasOne('App\Functie', 'functieId', 'functieId');
    }

    public function teams()
    {
        return $this->hasMany('App\Functie', 'werknemerNummer', 'id');
    }
}
