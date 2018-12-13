<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Checklist;
use App\Task;
use App\Listgroup;
use App\Icon;
use App\Chore;

use Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Log;

class MainController extends Controller
{

  public function __construct()
  {
        $this->middleware('auth');

        // Sharing is caring
        $this->icons          = Icon::all();
        $this->user           = Auth::user();
        //$user                 = Auth::user();
        //$this->groups         = $user->groups;
        view()->share('icons', $this->icons);
        view()->share('user', $this->user);
        //view()->share('groups', $this->groups);
  }

/*
*
* TASK FUNCTIONS --------------------------------------------
*
*/

  public function index()
  {
      $user   = Auth::user();
      $groups = $user->groups;
      if($groups->isEmpty()){
        $new = false;
        return view('templates.new-group', compact('user','new'));
      }
      $members = new \Illuminate\Database\Eloquent\Collection;
      $lists  = new \Illuminate\Database\Eloquent\Collection;

      foreach($groups as $group){
        $new = $group->lists;
        $lists = $lists->merge($new);

        $new = $group->users;
        $members = $members->merge($new);
      }

      if($lists->isEmpty()){
        $group = $user->groups->first();
        return view('templates.new-list', compact('user','groups','members','group'));
      }

      return view('templates.all-lists', compact('user','lists','groups','members'));
  }

  public function status(Request $request)
  {
      // Mark as complete if incomplete
      $post_id = $request['postId'];
      $task = Task::find($post_id);
      // mark incomplete if complete
      if($task->status ==1){
        $task->status = 0;
      }
      // Otherwise Mark Complete
      else{
        $task->status = 1;
      }

      $task->save();

      return 'true';

  }

  public function time(Request $request)
  {
      // Start or Stop Task Time
      $post_id = $request['postId'];
      $task = Task::find($post_id);
      // mark as stopped if started
      if(isset($task->started_at)){
        $task->stopped_at = time();
        $task->status = 1;
      }
      // Otherwise Mark started
      else{
        $task->started_at = time();
      }

      $task->save();

      return 'true';

  }

  public function newtask(Request $request)
  {
    $user = Auth::user();
    $task = new Task;
    $task->title = $request['task'];
    $task->status = 0;
    $assigned_to = User::find($request['assigned']);
    $list = Checklist::find($request['list']);
    $task->creator()->associate($user);
    $task->assignedto()->associate($assigned_to);
    $task->checklist()->associate($list);
    $task->save();
    return redirect()->route('list',['id' => $list->id]);
  }

/*
*
* LIST FUNCTIONS   --------------------------------------------
*
*/

  public function newlist(Request $request)
  {
      $user = Auth::user();
      $list = new Checklist;
      $list->title = $request['list'];
      $list->icon = $request['icon'];
      $list->creator()->associate($user);
      $list->save();
      $group = Listgroup::find($request['group']);
      $list->groups()->attach($group);
      return redirect()->route('list',[$list]);
  }

  public function deletelist(Request $request)
  {
      // delete list
  }

  public function mylist(Request $request)
  {
      // show list of all tasks assigned to you
      $user = Auth::user();
      $groups = $user->groups;

      $complete = $user->assigned->where('status', 1);
      $incomplete = $user->assigned->where('status', 0);

      $lists  = new \Illuminate\Database\Eloquent\Collection;
      if($groups->isEmpty()){
        return view('templates.new-group', compact('user'));
      }
      foreach($groups as $group){
        $new = $group->lists;
        $lists = $lists->merge($new);
      }

      return view('templates.mylist', compact('user','groups','incomplete','lists','complete'));
  }

  public function list($id)
  {
      $user = Auth::user();
      $list = Checklist::find($id);
      $groups = $user->groups;
      $lists  = new \Illuminate\Database\Eloquent\Collection;
      if($groups->isEmpty()){
        return view('templates.new-group', compact('user'));
      }
      foreach($groups as $group){
        $new = $group->lists;
        $lists = $lists->merge($new);
      }
      $group = $list->groups->first();
      $members = $group->users;
      $complete = $list->tasks->where('status', 1);
      $incomplete = $list->tasks->where('status', 0);
      return view('templates.list', compact('user','groups','incomplete','list','lists','members','complete'));
  }

/*
*
* GROUP FUNCTIONS   --------------------------------------------
*
*/


  public function newgroup()
  {
      $user   = Auth::user();
      if(count($user->groups)>0){
        $new = true;
      }
      return view('templates.new-group', compact('user','new'));
  }

  public function savegroup(Request $request)
  {
      $user   = Auth::user();
      $user->confirmed = 1;
      $user->save();
      $group = new Listgroup;
      $group->name = $request['title'];
      $group->save();
      $group->users()->attach($user);
      return redirect()->route('home');
  }
  public function managegroup($group)
  {
      $user = Auth::user();
      $groups = $user->groups;
      $group = Listgroup::find($group);
      foreach($group->users as $member){
        if($member->id == $user->id){
          $canedit = true;
        }
      } //
      if(isset($canedit)){
        return view('templates.manage-group', compact('user','group', 'groups'));
      }
      else {
        return "what are you trying to do, editting someone else's group?";
      }

  }

  public function groupinvite(Request $request, $group)
  {
      $user = Auth::user();
      $group = Listgroup::find($group);
      $groups = $user->groups;
      foreach($group->users as $member){
        if($member->id == $user->id){
          $canedit = true;
        }
      }
      if(isset($canedit)){
        foreach($request['invite'] as $invite){
          $i = User::where('phone', $invite)->orWhere('email',$invite)->first();
          if(isset($i)){
            $already = $i->groups;
            foreach($already as $a){
              if($a->id == $group->id){
                $alreadymember = true;
              }
            }
            if(isset($alreadymember)){
              $request->session()->flash('notice','This account should already be a member of your group!');
            }
            else {
              $request->session()->flash('notice','Success! You will be collaborating in no time!');
              $i->groups()->attach($group);
            }
          }
          else {
            if(is_numeric(substr($invite,1))){
              // send text or something?
            }
            else {
              $message = "Hey! Listen!\r\n".$user->name." has invited you to their group. Create a Lister account!\r\n";
              mail($invite, 'Invite to Lister', $message);
            }
          }
        }
      }
      else {
        return "what are you trying to do, inviting people to someone else's group?";
      }
      return view('templates.manage-group', compact('user','group','groups'));
  }

  public function groupremove(Request $request, $group)
  {
      $user = Auth::user();
      $group = Listgroup::find($group);
      foreach($group->users as $member){
        if($member->id == $user->id){
          $canedit = true;
        }
      }
      if(isset($canedit)){
        $user_id = $request['postId'];
        $remove = User::find($user_id);
        $remove->groups()->detach($group);
      }
      else {
        return "what are you trying to do, removing people from someone else's group?";
      }

  }

/*
*
* USER FUNCTIONS   --------------------------------------------
*
*/
  public function profile(Request $request)
  {
      $user = Auth::user();
      $groups = $user->groups;
      if($groups->isEmpty()){
        return view('templates.new-group', compact('user'));
      }
      $members = new \Illuminate\Database\Eloquent\Collection;
      $lists  = new \Illuminate\Database\Eloquent\Collection;

      foreach($groups as $group){
        $new = $group->lists;
        $lists = $lists->merge($new);

        $new = $group->users;
        $members = $members->merge($new);
      }
      return view('templates.profile', compact('user','groups','members'));
  }

  public function saveprofile(Request $request)
  {
      $user = Auth::user();
      $group = Listgroup::find($group);

  }

}