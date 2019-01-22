<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 26/10/18
 * Time: 16:15
 */

namespace Tests\Feature;


use App\User;
use http\Env\Request;
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
        //1
        factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        $this->assertNull(Auth::user());
        // 2
        $response = $this->post('/login',[
            'email' => 'prova@gmail.com', //$user->email
            'password' => 'secret'
        ]);
//        dd($response);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals('prova@gmail.com',Auth::user()->email);


    }
    /**
     * @test
     */
    public function cannot_login_an_user_with_incorrec_user()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        $this->assertNull(Auth::user());
        // 2
        $response = $this->post('/login',[
            'email' => 'provaasdasdasd@gmail.com', //$user->email
            'password' => 'secret'
        ]);
//        dd($response);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }

}