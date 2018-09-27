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

//controlador tasques
//TDD-> test driven development

Route::get('/tasks',function (){
    return view('tasks');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about',function (){
    return view('about');
});

//Route::view();
Route::view('/contact', 'contact');


//Route::get('/prova','ProvaController@show');
Route::get('/prova',function (){
        $prova='hola tt';
        dd($prova);
//    echo '<h1>Hola mon</h1>';


});

Route::redirect('/hola','prova');
