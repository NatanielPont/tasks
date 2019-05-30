<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTasksIndex;
use App\Http\Requests\UserTasksShow;
use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TasquesController extends Controller
{

    public function index(UserTasksIndex $request)
    {
        if (Auth::user()->can('tasks.manage')) {
            if (Auth::user()->admin){

            $tasks =  map_collection(Task::orderBy('created_at','desc')->get());
            }else {

            $tasks = Cache::rememberForever(Task::TASKS_CACHE_KEY, function () {
                return  map_collection(Task::with('user', 'tags')->orderBy('created_at', 'desc')->get());
            });
            }
            $uri = '/api/v1/tasks';
        } else {
//            dd('hola');
//        dd('hola');
            $tasks =  map_collection($request->user()->tasks);
            $uri = '/api/v1/user/tasks';
        }
        $users = map_collection(User::all());
        $tags = map_collection(Tag::all());
        return view('tasques',compact('tasks','users','uri','tags'));
    }
    public function show(UserTasksShow $request)
    {
        // MVC
        if ($task = Task::where('id', '=', $request->id )->with('user')->exists()){
            $task=Task::where('id', '=', $request->id )->with('user')->first()->toJson();
            $tags = map_collection(Tag::all());
            return view('tasks.user.show', compact('task', 'tags'));
        }
        return redirect()->back();
//        $task = Task::where('id', '=', $request->id )->with('user')->first()->toJson();
    }

//    public function addTagTask(Request $request){
//
//
//
//    }
}
