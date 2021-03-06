<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Static Pages
Route::get('/', array( 'as' => 'home', 'uses' => 'PageController@home'));

Route::get('create',  array('as' => 'create' , 'uses' => 'TyperController@create'));
Route::post('create', 'TyperController@store');

Route::get('manage',  array('as' => 'manage' , 'uses' => 'TyperController@manage'));
Route::delete('{id}/delete', array('as' => 'delete' , 'uses' =>'TyperController@destroy'));

// Logged in only
Route::group(array('before' => 'auth'),function(){

    Route::get('manage/import',  array('as' => 'importCookieTypers' , 'uses' => 'TyperController@importCookieTypers'));

    Route::get('supermanage',  array('as' => 'supermanage' , 'uses' => 'TyperController@supermanage'));

	Route::put('{id}/feature',  array('as' => 'feature' , 'uses' => 'TyperController@setFeatured'));
    Route::delete('{id}/unfeature',  array('as' => 'unfeature' , 'uses' => 'TyperController@unsetFeatured'));

});


// User Registration
Route::get('user/create', array('as' => 'userCreate' , 'uses' => 'UserController@create'));
Route::post('user/create', array('as' => 'userStore' , 'uses' => 'UserController@store'));

// Login & Out
Route::get('login',  array('as' => 'login' , 'uses' => 'PageController@login'));
Route::post('login', 'AuthController@create');

Route::get('logout',  array('as' => 'logout' , 'uses' => 'AuthController@destroy'));

// Password Reminder / Reset
Route::get('password/reset', array('uses' => 'RemindersController@getRemind', 'as' => 'password.remind'));
Route::post('password/reset', array('uses' => 'RemindersController@postRemind', 'as' => 'password.request'));

Route::get('password/reset/{token}', array('uses' => 'RemindersController@getReset','as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => 'RemindersController@postReset','as' => 'password.update'));

Route::get('404', array('as' => '404' , 'uses' => 'PageController@notfound'));
Route::get('legal',  array('as' => 'legal' , 'uses' => 'PageController@legal'));

// Typer items
Route::get('{slug}', array('as' => 'show' , 'uses' => 'TyperController@show'));
Route::get('{slug}/shot', array('as' => 'shot' , 'uses' => 'TyperController@shot'));