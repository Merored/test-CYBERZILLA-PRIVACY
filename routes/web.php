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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth',], function(){
    
    Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

    Route::get('users/{user_id}/todos', ['as' => 'users.todos', 'uses'  =>  'TasksController@index']);
    Route::post('users/{user_id}/todos', ['as' => 'users.todos.store', 'uses'  =>  'TasksController@store']);
    Route::get('users/{user_id}/todos/{id}', ['as' => 'users.todos.show', 'uses'  =>  'TasksController@show']);
    Route::put('users/{user_id}/todos/{id}', ['as' => 'users.todos.edit', 'uses'  =>  'TasksController@update']);
    Route::delete('users/{user_id}/todos/{id}', ['as' => 'users.todos.delete', 'uses'  =>  'TasksController@destroy']);
    
});

Route::get('/home', 'HomeController@index')->name('home');
