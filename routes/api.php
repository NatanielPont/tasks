<?php

use App\Task;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
//Route::get('/', function () {
//    return view('welcome');
//});
//Route::post('/login_alt','Auth\LoginAltController@login');

Route::middleware('auth:api')->group(function() {

    Route::get('/v1/tasks','Api\TasksController@index'); //browser

    Route::get('/v1/tasks/{task}','Api\TasksController@show'); //read
    Route::delete('/v1/tasks/{task}','Api\TasksController@destroy'); //delete
    Route::post('/v1/tasks','Api\TasksController@store'); //create
    Route::put('/v1/tasks/{task}','Api\TasksController@update');         // EDIT
    // Completed tasks -> Estats
    Route::delete('/v1/completed_task/{task}','Api\CompletedTasksController@destroy');
    Route::post('/v1/completed_task/{task}','Api\CompletedTasksController@store');

    Route::post('/v1/tags','Api\TagsController@store');
    Route::get('/v1/tags','Api\TagsController@index');
    Route::get('/v1/tags/{tag}','Api\TagsController@show');
    Route::delete('/v1/tags/{tag}','Api\TagsController@destroy');
    Route::put('/v1/tags/{tag}','Api\TagsController@update');

    Route::get('/v1/user/tasks','Api\LoggedUserTasksController@index');
    Route::put('/v1/user/tasks/{task}','Api\LoggedUserTasksController@update');




    // Users
    Route::get('/v1/users','Api\UsersController@index');
    Route::get('/v1/regular_users','Api\RegularUsersController@index');
});


