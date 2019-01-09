<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GitIndex;
use App\Http\Requests\TasksShow;
use App\Http\Requests\TasksStore;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cache;


class GitController extends Controller
{


    /**
     * Index.
     * @param GitIndex $request
     * @return mixed
     */
    public function index(GitIndex $request)
    {
        Cache::forget('git_info');
        return git();
    }

}
