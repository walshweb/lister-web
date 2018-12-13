<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

  use SoftDeletes;
  public function checklist() {
      return $this->belongsTo('App\Checklist');
  }
  public function assignedto() {
      return $this->belongsTo('App\User','id','assigned_to');
  }
  public function creator() {
      return $this->belongsTo('App\User');
  }
  public function completer() {
      return $this->belongsTo('App\User');
  }
  public function parent() {
        return $this->belongsTo('App\Task');
  }
  public function children() {
        $children = Task::where('parent_id', $this->id)->get();
        return $children;
  }
}
