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

class LoginAltControllerTest extends TestCase
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
            'email'=>'provaName@gmail.com',
        ]);
        $this->assertNull(Auth::user());
        //
        $response=$this->post('/login_alt',['email'=>$user->email,
            'password'=>'secret']);
//        dd("hola");
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
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        $this->assertNull(Auth::user());
        $response = $this->post('/login_alt',[
            'email' =>$user->email, //$user->email
            'password' => 'asdjaskdlasdasd0798asdjh'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }
    /**
     * @test
     */
    public function cannot_login_an_user_with_incorrect_user()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);
        $this->assertNull(Auth::user());
        // 2
        $response = $this->post('/login_alt',[
            'email' => 'provaasdasdasd@gmail.com', //$user->email
            'password' => 'secret'
        ]);
//        dd($response);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }

}