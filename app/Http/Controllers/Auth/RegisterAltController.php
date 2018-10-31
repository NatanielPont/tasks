<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterAltController extends Controller
{
    public function register(Request $request)
    {
        //TODO-> validation
        $request->email;
        $request->password;
        //buscar en bd l'susuari i comprovar password
        $user=User::where('email',$request->email)->first();
        if (!$user) {
            factory(User::class)->create([
                'email' => $request->email,
                'name'=>$request->name,
                'password'=>$request->password
            ]);
            return redirect('/');
        };
        echo "L'usuari ja existeix";
//        if (Hash::check($request->password,$user->password)) return redirect('/');
//        Auth::login($user);
        return redirect('/home');
   }
}
