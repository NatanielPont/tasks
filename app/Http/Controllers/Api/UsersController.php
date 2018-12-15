<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        return Task::orderBy('created_at')->get();
    }

}
