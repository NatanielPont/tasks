<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegularUsersController extends Controller
{


    public function index(Request $request)
    {
        // Scopes
        return map_collection(User::regular()->get());
    }


}
