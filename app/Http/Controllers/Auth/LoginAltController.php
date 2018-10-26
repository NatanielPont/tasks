<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 26/10/18
 * Time: 16:45
 */

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;

class LoginAltController
{
    public function Login(Request $request)
    {
        //TODO-> validation
        dd('hola');
        $request->email;
        $request->password;
        //buscar en bd l'susuari i comprovar password
        $user=User::where('email',$request->email)->first();
        if (!$user) return redirect('/');
        if (Hash::check($request->password,$user->password)) return redirect('/');
        Auth::login($user);
        return redirect('/home');

    }

}