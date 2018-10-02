<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //

    public function index()
    {
        $tasks=Task::all();
        return view('tasks',['tasks'=>$tasks]);
        
    }

    public function store(Request $request)
    {
        // object Request
        Task::create([
            'name'=>$request->name,
            'completed'=>false
        ]);

        //Retornar a /tasks
        return redirect('/tasks');
        
    }

    public function destroy(Request $request)
    {
//        dd($request->id);
        $task = Task::findOrFail($request->id);
        $task->delete();
        // Retornar a /tasks
        return redirect()->back();
    }

    public function update(Request $request)
    {
//        dd($request->id);

        //models-eloquent
        //libreria laravel to work with queryes
        //ORM->object relational model (Hibernate Java)
//        dd(Task::find($request->id));
//        if (!Task::find($request->id)) return response(404,'No he trobat res');
        $task = Task::findOrFail($request->id);
        $task->name=$request->name;
        $task->completed=true;
        $task->save();
        return $task;

    }

    public function edit(Request $request)
    {
        $task=Task::findOrFail($request->id);
        return view('task_edit',compact('task'));
//        return view('task_edit',['task'=>'task']);

    }



}
    class CompletedTaskController {

        }
