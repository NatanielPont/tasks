<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ShowTasks;
use App\Http\Requests\StoreTasks;
use App\Http\Requests\UpdateTasks;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{

    public function index(Request $request)
    {
        abort(404);

        return map_collection(Task::orderBy('created_at')->get());
    }
    public function show(ShowTasks $request, Task $task) // Route Model Binding
    {

        return $task->map();
    }
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
    }
    public function store(StoreTasks $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return $task->map();
    }
    public function update(UpdateTasks $request, Task $task)
    {

//        dd($task->map());
        $task->name = $request->name;
//        $task->completed=false;
        $task->save();
//        dd('hola');
        return $task->map();
    }

}
