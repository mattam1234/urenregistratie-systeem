<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class functie extends Model
{


    protected $table = 'functies';

    public $primaryKey = 'functieId';



    public function User()
    {
        return $this->belongsTo('App\User', 'functieId','functieId');
    }
}
