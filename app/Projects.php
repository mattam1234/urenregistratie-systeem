<?php

namespace App;

use App\ProjectTasks;
use Illuminate\Database\Eloquent\Model;
use App\Categories;
use App\User;

class Projects extends Model
{
    protected $fillable=['title','category_id','start_date','end_date','description','status'];

    public function category(){
        return $this->belongsTo(Categories::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'id','werknemerNummer');
    }
    public function project_task(){
        return $this->hasMany(ProjectTasks::class);
    }
}
