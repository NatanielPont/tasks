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

Auth::routes();

//TODO
Route::post('/login_alt','Auth\LoginAltController@login');
Route::post('/register_alt','Auth\RegisterAltController@register');

Route::middleware(['auth'])->group(function (){
Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store');
Route::delete('/tasks/{id}','TasksController@destroy');
Route::put('/tasks/{id}','TasksController@update');
Route::get('/task_edit/{id}','TasksController@edit');

Route::post('/completed_task','CompletedTaskController@store');
Route::delete('/completed_task','CompletedTaskController@destroy');


Route::get('/about',function (){
    return view('about');
});

Route::view('/contact', 'contact');

Route::get('/tasks_vue','TasksVueController@index');
Route::get('/tasques','TasquesController@index');
Route::get('/home', 'TasksVueController@index');
// USER TASKS
    Route::get('/user/tasks','LoggedUserTasksController@index');

});
Route::get('/', function () {
    return view('welcome');
});
//TDD-> test driven development
//controlador tasques



//index -> list
//store -> create
//delete-> destroy
// edit-> put
//Tags

