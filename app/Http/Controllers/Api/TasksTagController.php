<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TagsStore;
use App\Http\Requests\TasksDestroy;
use App\Http\Requests\TasksIndex;
use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Http\Requests\TasksUpdate;
use App\Tag;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksTagController extends Controller
{

    public function store(Request $request, Task $task)
    {
//        dd($request->id);
//        dd($request);
//        dd($request->tag[0]['name']);
//       $tag = new Tag();
//        $tag->name = $request->name;
////        $tag->description = $request->description;
////        $tag->color = $request->color;
//        $tag->save();
        $tag = Tag::findOrFail($request->tag['id']);
//        $neededObject = array_filter(
//            $task->tags(),
//            function ($e) use (&$searchedValue) {
//                return $e->id == $searchedValue;
//            }
//        );
//        if ($task->tags())
//        dd($task);
        $task->addTag($tag);
////        $task->save();
        return $tag->map();
    }
    public function destroy(Request $request, Task $task)
    {
//        dd($request->tag['id']);
        $tag = Tag::findOrFail($request->tag['id']);
        $task->removeTag($tag);
//        $task->save();
        return $task->map();
    }
//

}
