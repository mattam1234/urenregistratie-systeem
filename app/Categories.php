<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tasks;
use App\Projects;

class Categories extends Model{
    protected $fillable=['category_title'];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'werknemerNummer');
    }

    public function tasks(){
        return $this->hasMany(Tasks::class);
    }

    public function projects(){
        return $this->hasMany(Projects::class);
    }
}
