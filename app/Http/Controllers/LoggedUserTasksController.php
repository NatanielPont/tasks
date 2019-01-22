<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoggedUserTasks;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Http\Requests\TasksStore;
//use App\Task;
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

class LoggedUserTasksController extends Controller
{
    public function index(LoggedUserTasks $request)
    {
        $uri = '/api/v1/user/tasks';
        $tasks = map_collection(optional(Auth::user())->tasks);
        return view('tasks.user.index',compact('tasks','uri'));
    }
}
