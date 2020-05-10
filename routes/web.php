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

/*Route::get('lang', function () {
    $lang = session('key', 'en');
    if($lang == 'en'){
       $lang = 'pt-BR';
    }else{
       $lang = 'en';
    }
     session(['key'=> $lang]);
     return redirect()->back();
 })->name('lang');
 
 Route::get('/', function () {
     $lang = session('key', 'en');
     App::setLocale($lang);
     return view('welcome');  
 });*/

Route::get('/', function () {
    return redirect('/home');  
});
 
 Auth::routes();
 
 Route::get('/home', 'HomeController@index')->name('home');
 
 Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {
     Route::resource('/users', 'UserController');
     Route::get('/users','UserController@index')->name('users.index')->middleware('can:crud_user_acl');
     Route::get('/users/create','UserController@create')->name('users.create')->middleware('can:crud_user_acl');
     Route::post('/users','UserController@store')->name('users.store')->middleware('can:crud_user_acl');
     Route::resource('/permissions', 'PermissionController')->middleware('can:crud_user_acl');;
     Route::resource('/roles', 'RoleController')->middleware('can:crud_user_acl');;

     Route::resource('/clients','ClientController');
     Route::resource('/phones','PhoneController');
     Route::get('/phones/create/{id}','PhoneController@create')->name("phones.create");
     Route::post('/phones/store/{id}','PhoneController@store')->name("phones.store");
     //Route::delete('/phones/destroy/{id}','PhoneController@destroy')->name("phones.destroy");

     Route::get('/logs','LogController@index')->name("logs.index");




 
 });
