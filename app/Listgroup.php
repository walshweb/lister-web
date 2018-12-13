<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listgroup extends Model
{
    //
    public function lists() {
        return $this->belongsToMany('App\Checklist');
	  }
    public function checklists() {
        return $this->belongsToMany('App\Checklist');
	  }
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
