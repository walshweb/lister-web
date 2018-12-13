<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function lists() {
        return $this->hasMany('App\List');
	  }
    public function groups() {
        return $this->belongsToMany('App\Listgroup');
	  }
    public function listgroups() {
        return $this->belongsToMany('App\Listgroup');
	  }
    public function assigned() {
        return $this->hasMany('App\Task','assigned_to');
	  }
    public function creator() {
        return $this->hasMany('App\Task','creator_id');
	  }
    public function completed() {
        return $this->hasMany('App\Task');
	  }
    public function chores() {
        return $this->belongsToMany('App\Chore');
	  }
}
