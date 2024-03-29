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


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClockController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LoggedUserPhotoController;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TasquesController;
use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);
//Route::bind('hashuser', function($value, $route)
//{
//    $hashids = new Hashids\Hashids(config('task.salt'));
//    $id = $hashids->decode($value)[0];
//    return User::findOrFail($id);
//});


Route::post('/login_alt', 'Auth\LoginAltController@login');
Route::post('/register_alt', 'Auth\RegisterAltController@register');

//Login with Social's Network
Route::get('/auth/{provider}','\\'.LoginController::class.'@redirectToProvider');
Route::get('/auth/{provider}/callback', '\\'. LoginController::class . '@handleProviderCallback');

Route::middleware(['auth'])->group(function () {
    Route::get('/tasks','\\'. TasksController::class . '@index');
    Route::post('/tasks','\\'. TasksController::class . '@store');
    Route::delete('/tasks/{id}','\\'. TasksController::class . '@destroy');
    Route::put('/tasks/{id}','\\'. TasksController::class . '@update');

//    Route::get('/editableForm/{id}', 'TasksController@edit');
    Route::get('/task_edit/{id}', 'TasksController@edit');
//    echo Form::open(array('/task_edit/{id}' => 'TasksController@edit'));


    //Complete
    Route::post('/completed_task/{task}', 'CompletedTasksController@store');
//    Route::post('/uncompleted_task/{task}', 'CompletedTasksController@uncomplete');
    //Uncomplete
    Route::delete('/completed_task/{task}', 'CompletedTasksController@destroy');


    Route::get('/about', function () {
        return view('about');
    });

    Route::view('/contact', 'contact');

    Route::get('/tasks_vue', 'TasksVueController@index');
    Route::get('/tasks_tailwind', 'TasksTailwindController@index');
    Route::get('/tasques', 'TasquesController@index');
    Route::get('/tasques/{id}','\\'.TasquesController::class.'@show');
    Route::get('/home', 'TasksVueController@index');
// USER TASKS
    Route::get('/user/tasks', 'LoggedUserTasksController@index');
    Route::impersonate();

    //TAGS
    Route::get('/tags','\\'. TagsController::class . '@index');



    Route::get('/profile', '\\'. ProfileController::class . '@show');
    Route::get('/mobile', '\\'. MobileController::class . '@index');
    Route::post('/photo', '\\'. PhotoController::class . '@store');
    Route::get('/user/photo', '\\'. LoggedUserPhotoController::class . '@show');

    //Changelog
    Route::get('/changelog','\\'. ChangelogController::class . '@index');

    Route::get('/notifications', '\\' . NotificationController::class . '@index');

    //clock
    Route::get('/clock', '\\' . ClockController::class . '@index');

    //chat
    Route::get('/chat', '\\' . ChatController::class . '@index');
    Route::get('/xat', '\\' . ChatController::class . '@index');
    Route::get('/users','\\'.UsersController::class.'@index');
    //Game
    Route::get('/game','\\'.GameController::class.'@index');
    Route::get('/multimedia','\\'.MultimediaController::class.'@index');


    //Newsletters
    Route::get('/newsletters', '\\' . NewslettersController::class . '@index');

    // Push Subscriptions
    Route::post('/subscriptions', '\\' . PushSubscriptionController::class . '@update');
    Route::post('/subscriptions/Delete', '\\' . PushSubscriptionController::class . '@destroy');




//    // User photos
//    Route::get('/user/{hashuser}/photo','\\' . UserPhotoController::class . '@show')->name('user.photo.show');
//    Route::get('/user/{hashuser}/photo/download', '\\' . UserPhotoController::class . '@download')->name('user.photo.download');

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
