<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    //parametres=dependencia
    public function show(Request $request, Task $task)
    {
//        dd($request->task);

        return $task;
        
        
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();

    }

    public function store(Request $request)
    {
//        Task::create();
        $task=new Task();
        $task->name=$request->name;
        $task->completed=$request->completed;
        $task->save();
        return $task;

    }
    public function index()
    {

    }public function edit(Request $request,Task $task)
    {
//        $task=Task::findOrFail($request->id);
        $task->fresh();
//        return view('task_edit',compact('task'));
        return $task;

    }
}
