<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTasks;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{

    public function index(Request $request)
    {
        return Task::orderBy('created_at')->get();
    }
    //parametres=dependencia
    public function show(Request $request, Task $task)
    {
//        dd($request->task);
        $task=Task::orderBy('created_at','desc')->get();

        return $task;
        
        
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();

    }

    public function store(StoreTasks $request)
    {
//        //opcio acceptable
//        $request->validate([
//            'name'=>'required'
//        ]);


        $task=new Task();
        $task->name=$request->name;
        $task->completed = false;
        $task->save();
        return $task;

    }


    public function edit(Request $request,Task $task)
    {
        $task->name = $request->name;
        $task->save();
        return $task;
////        $task=Task::findOrFail($request->id);
//        $task->fresh();
////        return view('task_edit',compact('task'));
//        return $task;

    }
}
