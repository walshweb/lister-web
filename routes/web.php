<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


  Route::post('/authme', 'HomeController@auth')->name('auth');
  Route::get('/', 'MainController@index')->name('home');
  Route::get('/home', 'MainController@index')->name('home');


  // user routes
  Auth::routes();
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
  Route::get('/profile','MainController@profile');
  Route::post('/profile','MainController@saveprofile');

  // task routes
  Route::post('/task/status/update','MainController@status');
  Route::post('/task/time/update','MainController@time');
  Route::post('/task/new','MainController@newtask');
  // list routes
  Route::post('/list/new','MainController@newlist');
  Route::get('/list/delete','MainController@deletelist');
  Route::get('/mylist','MainController@mylist');
  // Show list
  Route::get('/list/{id}','MainController@list')->name('list');
  // Group routes
  Route::get('/group/new','MainController@newgroup');
  Route::post('/group/save','MainController@savegroup');

  Route::get('/group/manage/{id}','MainController@managegroup'); // new
  Route::post('/group/{id}/invite','MainController@groupinvite'); // by email or phone
  Route::post('/group/{id}/remove','MainController@groupremove'); // by email or phone
  // Chores
  Route::get('/chores','MainController@chores');
  Route::post('/chore/complete','MainController@completeChore');
  // goals
  Route::get('/goals','MainController@goals'); // Show acomplishments - chore points vs group members - tasks completed this month




/*
  Route::get('/teststuff', function () {
    $thing = file_get_contents ('http://lister.local/assets/fontawesome5.3.1/css/fontawesome.css');
    $things = explode('.', $thing);
    $count = 0;
    $array = [];
    foreach($things as $thing){
      if(substr($thing,0,3)== 'fa-'){
        $count++;
        preg_match('/(.*?):/', $thing, $match);
        foreach($match as $m){
          //echo $match[1];
          array_push($array, $match[1]);
          //echo '<br>';
        }
      }
    }
    $shizzle = array_unique($array);
    //return $shizzle;
    echo '<ul>';
    foreach($shizzle as $s){
      echo '<li class="icon" data="';
      echo $s;
      echo '"><i class="fas ';
      echo $s;
        $icon = new App\Icon;
        $icon->slug = $s;
        $icon->full = 'fas '.$s;
        $icon->save();



      echo '"></i></li>';
    }
    echo '</ul>';
    //var_dump($match);
    //return $things;
    //return $count;
  });
  */