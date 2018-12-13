<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Checklist;
use App\Task;

use Image;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Log;

class HomeController extends Controller
{

  public function __construct()
  {

  }

/*
*
* TASK FUNCTIONS
*
*/

  public function auth(Request $request)
  {
    $x = User::orderBy('created_at', 'desc')->first();
    $x = $x->id;
    $x = $x++;
    $user = User::firstOrCreate(['phone' => $request['phone']], ['name' => 'newuser'.$x], ['email' => 'user'.$x.'@your.email']);

    if($user)  {
      Auth::login($user);
      return redirect()->intended('home');

    }
  }

}