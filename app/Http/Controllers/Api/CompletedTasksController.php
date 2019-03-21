<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskCompletedEvent;
use App\Events\TaskUncompletedEvent;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController
{
    public function destroy(Request $request, Task $task)
    {
        $task->completed=false;
        $task->save();
//        return redirect('/tasks');

        //  HOOK -> EVENT
        event(new TaskUncompletedEvent($task));

    }
    public function store(Request $request, Task $task)
    {
        $task->completed=true;
        $task->save();

        //  HOOK -> EVENT
        event(new TaskCompletedEvent($task));
//        return redirect('/tasks');

    }
}
