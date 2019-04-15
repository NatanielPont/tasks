<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 15/04/19
 * Time: 12:29
 */

namespace App\Http\Controllers;


use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = map_collection(User::all());
        return view('users.index',compact('users'));
    }
}
