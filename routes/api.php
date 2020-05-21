<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
   
    Route::post('auth/login',['as' => 'auth.login', 'uses'  => 'AuthController@login']);

    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::post('auth/authorized', ['as' => 'auth.authorized', 'uses'  =>  'AuthController@authorized']);
        Route::post('auth/logout', ['as' => 'auth.logout', 'uses'  =>  'AuthController@logout']);
        Route::post('auth/refresh', ['as' => 'auth.user', 'uses'  =>  'AuthController@refresh']);



        Route::get('users/{user_id}/todos', ['as' => 'users.todos', 'uses'  =>  'TasksController@index']);
        Route::post('users/{user_id}/todos', ['as' => 'users.todos.store', 'uses'  =>  'TasksController@store']);
        Route::get('users/{user_id}/todos/{id}', ['as' => 'users.todos.show', 'uses'  =>  'TasksController@show']);
        Route::put('users/{user_id}/todos/{id}', ['as' => 'users.todos.edit', 'uses'  =>  'TasksController@update']);
        Route::delete('users/{user_id}/todos/{id}', ['as' => 'users.todos.delete', 'uses'  =>  'TasksController@destroy']);
       
        
    });
});
