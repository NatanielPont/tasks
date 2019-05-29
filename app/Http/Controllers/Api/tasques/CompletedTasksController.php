<?php

namespace App\Http\Controllers\Api;


use App\Events\TaskCompletedEvent;
use App\Events\TaskUncompletedEvent;
use App\Task;
use Illuminate\Http\Request;
//use Auth;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;

class CompletedTasksController
{
    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();
//        return redirect('/tasks');

        //  HOOK -> EVENT
        event(new TaskUncompletedEvent($task,Auth::user()));

    }
    public function store(Request $request, Task $task)
    {
        $task->completed=true;
        $task->save();

        //  HOOK -> EVENT
        event(new TaskCompletedEvent($task,Auth::user()));
//        return redirect('/tasks');

    }
}
