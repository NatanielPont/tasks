<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowTasks;
use App\Http\Requests\StoreTasks;
use App\Http\Requests\UpdateTasks;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //

    public function index(ShowTasks $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks', ['tasks' => $tasks]);

    }




    public function store(StoreTasks $request)
    {
        if (strlen($request->name) > 20)
            $request->name = substr($request->name, 0, 20);
        // object Request
        $task=Task::create([
            'name' => $request->name,
            'completed' => false
        ]);
//        dd($task->name);

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

    public function update(UpdateTasks $request)
    {
        // Models -> Eloquent -> ORM (HIBERNATE de Java) Object Relation Model
        $task = Task::findOrFail($request->id);

        if ($request->name) {
            if (strlen($request->name) > 20)
                $request->name = substr($request->name, 0, 20);
            $task->name = $request->name;
        }
        $task->completed = $request->completed;
        $task->save();
        return redirect('/tasks');
    }

    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit', compact('task'));

    }


}

