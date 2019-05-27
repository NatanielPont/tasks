<?php

use App\Http\Controllers\Api\Changelog\ChangelogController;
use App\Http\Controllers\Api\chat\ChatMessageController;
use App\Http\Controllers\Api\GitController;
use App\Http\Controllers\Api\LoggedUserTasksController;
use App\Http\Controllers\Api\NewslettersController;
use App\Http\Controllers\Api\Notifications\HelloNotificationController;
use App\Http\Controllers\Api\Notifications\NotificationsController;
use App\Http\Controllers\Api\Notifications\SimpleNotificationsController;
use App\Http\Controllers\Api\Notifications\UnreadNotificationsController;
use App\Http\Controllers\Api\Notifications\UserNotificationsController;
use App\Http\Controllers\Api\Notifications\UserUnreadNotificationsController;
use App\Http\Controllers\Api\OnlineUsersController;
use App\Http\Controllers\Api\push_subscription\PushSubscriptionController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\TasksController;
use App\Http\Controllers\Api\TasksTagsController;
//use App\Http\Controllers\Ap\PushSubscriptionController;
//use App\Http\Controllers\PushSubscriptionController;
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
    Route::get('/v1/tasks','\\' . TasksController::class . '@index');                // BROWSE
    Route::get('/v1/tasks/{task}','\\' . TasksController::class . '@show');          // READ
    Route::delete('/v1/tasks/{task}','\\' . TasksController::class . '@destroy');    // DELETE
    Route::post('/v1/tasks','\\' . TasksController::class . '@store');               // CREATE
    Route::put('/v1/tasks/{task}','\\' . TasksController::class . '@update');        // EDIT
    Route::post('/v1/tasks/{task}/tag','\\' . TasksTagsController::class . '@store');        // EDIT
    Route::delete('/v1/tasks/{task}/tag','\\' . TasksTagsController::class . '@destroy');        // EDIT
    Route::put('/v1/tasks/{task}/tags', '\\' . TasksTagsController::class . '@update' );



//    Route::get('/v1/tasks','Api\TasksController@index'); //browser
//
//    Route::get('/v1/tasks/{task}','Api\TasksController@show'); //read
//    Route::delete('/v1/tasks/{task}','Api\TasksController@destroy'); //delete
//    Route::post('/v1/tasks','Api\TasksController@store'); //create
//    Route::put('/v1/tasks/{task}','Api\TasksController@update');         // EDIT
    // Completed tasks -> Estats
    Route::delete('/v1/completed_task/{task}','Api\CompletedTasksController@destroy');
    Route::post('/v1/completed_task/{task}','Api\CompletedTasksController@store');

//    Route::post('/v1/tags','Api\TagsController@store');
//    Route::get('/v1/tags','Api\TagsController@index');
//    Route::get('/v1/tags/{tag}','Api\TagsController@show');
//    Route::delete('/v1/tags/{tag}','Api\TagsController@destroy');
//    Route::put('/v1/tags/{tag}','Api\TagsController@update');
    // TAGS
    Route::get('/v1/tags','\\'. TagsController::class . '@index');                // BROWSE
    Route::get('/v1/tags/{tag}','\\'. TagsController::class . '@show');          // READ
    Route::delete('/v1/tags/{tag}','\\'. TagsController::class . '@destroy');    // DELETE
    Route::post('/v1/tags','\\'. TagsController::class . '@store');               // CREATE
    Route::put('/v1/tags/{tag}','\\'. TagsController::class . '@update');         // EDIT


    Route::get('/v1/user/tasks','\\' . LoggedUserTasksController::class . '@index');
    Route::put('/v1/user/tasks/{task}','\\' . LoggedUserTasksController::class . '@update');
    Route::get('/v1/user/tasks/{task}','\\' . LoggedUserTasksController::class . '@show');
    Route::post('/v1/user/tasks','\\' . LoggedUserTasksController::class . '@store');
    Route::delete('/v1/user/tasks/{task}','\\' . LoggedUserTasksController::class . '@destroy');

    // Users
    // Users
    Route::get('/v1/users','Api\UsersController@index');
    Route::get('/v1/regular_users','Api\RegularUsersController@index');
//    Route::get('/v1/users','Api\UsersController@index');
//    Route::get('/v1/regular_users','Api\RegularUsersController@index');
    Route::get('/v1/git/info','\\' . GitController::class . '@index');

    // Notifications
    Route::get('/v1/notifications','\\' . NotificationsController::class . '@index');
    Route::post('/v1/notifications/multiple','\\' . NotificationsController::class . '@destroyMultiple');
    Route::delete('/v1/notifications/{notification}','\\' . NotificationsController::class . '@destroy');
    Route::get('/v1/user/notifications','\\' . UserNotificationsController::class . '@index');
    Route::get('/v1/user/unread_notifications','\\' . UserUnreadNotificationsController::class . '@index');
    Route::delete('/v1/user/unread_notifications/all','\\' . UserUnreadNotificationsController::class . '@destroyAll');
    Route::delete('/v1/user/unread_notifications/{notification}','\\' . UserUnreadNotificationsController::class . '@destroy');

    Route::post('/v1/unread_notifications/{notification}','\\' . UnreadNotificationsController::class . '@destroy');

    //hello notification
    Route::post('/v1/notifications/hello','\\' . HelloNotificationController::class . '@store');


    // Simple notifications
    Route::post('/v1/simple_notifications/','\\' . SimpleNotificationsController::class . '@store');
//    Route::post('/v1/notifications/hello','\\' . HelloNotificationController::class . '@store');



    //Changelog
    Route::get('/v1/changelog','\\' . ChangelogController::class . '@index');
    //online users
    Route::get('/v1/users/online', '\\'. OnlineUsersController::class .'@index');

    Route::get('/v1/channel/{channel}/messages', '\\' . ChatMessageController::class . '@index');
    Route::post('/v1/channel/{channel}/messages', '\\' . ChatMessageController::class . '@store');
    Route::delete('/v1/channel/{channel}/messages/{message}', '\\' . ChatMessageController::class . '@destroy');

    Route::post('/v1/unread_notifications/{notification}','\\' . UnreadNotificationsController::class . '@destroy');
    // Push Subscriptions
    Route::put('/v1/subscriptions', '\\' . PushSubscriptionController::class . '@update');
    Route::post('/v1/subscriptions/delete', '\\' . PushSubscriptionController::class . '@destroy');



});
Route::post('/v1/newsletter', '\\' . NewslettersController::class . '@store');



