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

class TasksController extends Controller
{

    public function index(TasksIndex $request)
    {
//        dd(map_collection(Task::orderBy('created_at','desc')->get()));
//        dd('hola');
        return map_collection(Task::orderBy('created_at','desc')->get());
    }
    public function show(TasksShow $request, Task $task) // Route Model Binding
    {
        return $task->map();
    }
    public function store(TasksStore $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = $request->completed ? true : false ;
        $task->user_id = $request->user_id;
        $task->save();
        return $task->map();
    }
    public function update(TasksUpdate $request, Task $task)
    {
//        dd('hola');

        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description;
        $task->user_id = $request->user;

        $task->save();
        return $task->map();
    }
    public function destroy(TasksDestroy $request, Task $task)
    {
        $task->delete();
        return $task;
    }

    public function storeTag(TagsStore $request, Task $task)
    {
        //abort(404);
//        dd($task);
        //dd($task->tags);

        //$tag = new Tag();


        $tags = $request->get('tags');
//        $array = json_decode(json_encode($tags), true);

//        dd(count($tags));
        foreach ($tags as $tag) {
            $taG = Tag::create([
                //dd($t != null ? $t['name'] : 'Hola'),
                'name' => $tag,
                'description' => $tags['description'] != null ? $tags['description'] : 'Afegeix descripció a '.$tags['name'],
                'color' => $tags['color'] || 'primary'
            ]);

            $taG->save();

            $task->addTag($taG);
        }

        //dd(count($tags));
//        if (count($array)<2){
//
//            $tag = Tag::create([
//                //dd($t != null ? $t['name'] : 'Hola'),
//                'name' => $tags,
//                'description' => $tags['description'] != null ? $tags['description'] : 'Afegeix descripció a '.$tags['name'],
//                'color' => $tags['color'] || 'primary'
//            ]);
//
//            $tag->save();
//
//            $task->addTag($tag);
//        } else {
//            foreach ($tags as $tag) {
//                $tag = Tag::create([
//                    //dd($t != null ? $t['name'] : 'Hola'),
//                    'name' => $tags,
//                    'description' => $tags['description'] != null ? $tags['description'] : 'Afegeix descripció a '.$tags['name'],
//                    'color' => $tags['color'] || 'primary'
//                ]);
//
//                $tag->save();
//
//            $task->addTag($tag);
//            }
//
//
//        }
//        foreach ($tags as $t){
//        }

        $task->refresh();

        $task->save();



        //dd($task->tags);

        return $task->map();

    }
//

}
