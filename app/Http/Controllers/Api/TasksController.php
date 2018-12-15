<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Http\Requests\TasksUpdate;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{

    public function index(Request $request)
    {
        return map_collection(Task::orderBy('created_at')->get());
    }
    public function show(TasksShow $request, Task $task) // Route Model Binding
    {

        return $task->map();
    }
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
    }
    public function store(TasksStore $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return $task->map();
    }
    public function update(TasksUpdate $request, Task $task)
    {

//        $task = Task::findOrFail($request->name);
        if ($request->name)
        $task->name = $request->name;
//        $task->completed=false;
        $task->save();
//        dd('hola');
        return $task->map();
    }

}
