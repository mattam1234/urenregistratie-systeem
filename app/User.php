<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mpociot\Teamwork\Traits\UserHasTeams;

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
    public function jobs()
    {
        return $this->hasOne('App\Jobs', 'werknemerNummer', 'id');
    }
    public function verlof()
    {
        return $this->hasMany('App\Verlof', 'werknemerNummer', 'id');
    }

    use UserHasTeams; // Add this trait to your model
}
