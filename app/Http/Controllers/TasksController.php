<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksDestroy;
use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Http\Requests\TasksUpdate;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //

    public function index(TasksShow $request)
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks', ['tasks' => $tasks]);

    }




    public function store(TasksStore $request)
    {
//        dd('juas juas');

        if (strlen($request->name) > 25)
            $request->name = substr($request->name, 0, 25);
        // object Request
        $task=Task::create([
            'name' => $request->name,
            'completed' => false
        ]);
//        dd($task->name);

        //Retornar a /tasks
        return redirect('/tasks');

    }

    public function destroy(TasksDestroy $request)
    {
        $task = Task::findOrFail($request->id);
        $task->delete();
        // Retornar a /tasks
        return redirect()->back();
    }

    public function update(TasksUpdate $request)
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

    public function edit(TasksUpdate $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit', compact('task'));

    }


}

