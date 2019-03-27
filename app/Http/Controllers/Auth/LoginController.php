<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use http\Url;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(Request $request, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'.$provider);
        }
        $authUser = $this->findOrCreateUser($user);
        $authUser->assignRole('Tasks');
        Auth::login($authUser, true);
        return Redirect::to('home');
    }

//    /**
//     * Redirect the user to the Facebook authentication page.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function redirectToProvider(Request $request, $provider)
//    {
//        return Socialite::driver($provider)->redirect();
//    }
//    /**
//     * Obtain the user information from GitHub.
//     *
//     * @return Response
//     */
//    public function handleProviderCallback()
//    {
//        try {
//            $user = Socialite::driver('github')->user();
//        } catch (Exception $e) {
//            return Redirect::to('auth/github');
//        }
//        $authUser = $this->findOrCreateUser($user);
//        $authUser->assignRole('Tasks');
//        Auth::login($authUser, true);
//        return Redirect::to('home');
//    }
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('email', $githubUser->email)->first()) {
            return $authUser;
        }
        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => str_random()
        ]);
    }

    public function showLoginForm()
    {
        if(!session()->has('url.intended')){
            session()->put('url.intended', url()->previous());
        }
        return view('auth.login');
    }
}
