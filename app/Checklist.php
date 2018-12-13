<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    //
    use SoftDeletes;
    public function tasks() {
        return $this->hasMany('App\Task');
	  }
    public function groups() {
        return $this->belongsToMany('App\Listgroup');
	  }
    public function creator() {
        return $this->belongsTo('App\User');
    }
}
