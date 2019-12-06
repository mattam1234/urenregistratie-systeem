<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teams extends Model
{
    //
    public function User()
    {
        return $this->belongsTo('App\User', 'werknemerNummer','id');
    }
}
