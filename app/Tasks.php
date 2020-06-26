<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tasks extends Model
{
    protected $fillable=['title','category_id','start_date','end_date','description','status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
