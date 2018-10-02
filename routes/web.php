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


Route::post('/completed_task','CompletedTaskController@store');
Route::delete('/completed_task','CompletedTaskController@destroy');
//controlador tasques
//TDD-> test driven development

Route::get('/tasks','TasksController@index');
Route::post('/tasks','TasksController@store');
Route::delete('/tasks/{id}','TasksController@destroy');
Route::put('/tasks/{id}','TasksController@update');
//Route::view('/task_edit/{id}','/task_edit');
Route::get('/task_edit/{id}','TasksController@edit');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about',function (){
    return view('about');
});

Route::view('/contact', 'contact');


Route::get('/prova',function (){
        $prova='hola tt';
        dd($prova);
});

Route::redirect('/hola','prova');
