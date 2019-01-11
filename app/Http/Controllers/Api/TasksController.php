<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TasksDestroy;
use App\Http\Requests\TasksIndex;
use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Http\Requests\TasksUpdate;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{

    public function index(TasksIndex $request)
    {
        return map_collection(Task::orderBy('created_at','desc')->get());
    }
    public function show(TasksShow $request, Task $task) // Route Model Binding
    {
        return $task->map();
    }
    public function store(TasksStore $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = $request->completed ? true : false ;
        $task->user_id = $request->user_id;
        $task->save();
        return $task->map();
    }
    public function update(TasksUpdate $request, Task $task)
    {
//        dd('hola');

        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description;
        $task->user_id = $request->user;

        $task->save();
        return $task->map();
    }
    public function destroy(TasksDestroy $request, Task $task)
    {
        $task->delete();
        return $task;
    }

}
