<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTasksIndex;
use App\Tag;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{

    public function index()
    {
//        dd('hola');

        return view('mobile.index');
    }

//    public function addTagTask(Request $request){
//
//
//
//    }
}
