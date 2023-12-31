<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index')->name('Welcome');
Auth::routes();

Route::group(['middleware' =>'auth'] , function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/posts', 'PostController');
    Route::get('/trashed-posts', 'PostController@trashed')->name('trashed.index');
    Route::get('/trashed-posts/{id}', 'PostController@restore')->name('trashed.restore');
   

});
Route::middleware(['auth','admin'])->group(function(){

    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::post('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

});

Route::middleware(['auth'])->group(function(){

    Route::get('/users/{user}/profile', 'UsersController@edit')->name('users.edit');
    Route::post('/users/{user}/profile', 'UsersController@update')->name('users.update');
   ;
  

});
