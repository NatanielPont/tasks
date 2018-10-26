<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 26/10/18
 * Time: 16:15
 */

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_login_a_user()
    {
        $this->withoutExceptionHandling();
        //
        $user=factory(User::class)->create([
            'email'=>'provaName@gmail.com'
//            'password'=>'secret'
        ]);
        $this->assertNull(Auth::user());

        //
        $response=$this->post('/login',['email'=>$user->email,
            'password'=>'secret']);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals('provaName@gmail.com',Auth::user()->email);

        //


    }
    /**
     * @test
     */
    public function cannot_login_an_user_with_incorrect_password()
    {
        $this->withoutExceptionHandling();
        //
        $user=factory(User::class)->create([
            'email'=>'provaName@gmail.com'
        ]);
        $this->assertNull(Auth::user());

        //
        $response=$this->post('/login',['email'=>$user->email,
            'password'=>'secret']);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNull(Auth::user());

        //


    }

}