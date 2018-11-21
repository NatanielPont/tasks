<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksTailwindController extends Controller
{
    //
    public function index()
    {

//        $tasks=Task::all();
        $tasks=Task::orderBy('created_at','desc')->get();
//        $tasks=[];
        return view('tasks_tailwind',compact('tasks'));
        
    }
}
