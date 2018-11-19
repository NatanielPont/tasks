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
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_register_a_user()
    {
        //afegir register_alt a fitxer routers/web.php
        //afegir Controller registerAltController i metode store
        //dins store
        //1)objecte request per validacio
        //2) user create
        //3)login
        //4)Redirect a home
        $this->withoutExceptionHandling();
        initialize_roles();
        //prepare
        $this->assertNull(Auth::user());
        $response=$this->post('/register',$user=[
            'name'=> 'Lalo',
            'email'=> 'lalo@gmail.com',
            'password'=>'secret',
            'password_confirmation'=> 'secret'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals($user['email'],Auth::user()->email);
        $this->assertEquals($user['name'],Auth::user()->name);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));

        //assert


    }

    /**
     * @test
     */
    public function cannot_register_an_user_with_incorrect_password()
    {
        $this->assertNull(Auth::user());
        $response=$this->post('/register',$user=[
            'name'=> 'Lalo',
            'email'=> 'lalo@gmail.com',
            'password'=>'tehthe',
            'password_confirmation'=> 'tehthe'
        ]);


//        $this->withoutExceptionHandling();
//        //
//        $user=factory(User::class)->create([
//            'email'=>'provaName@gmail.com'
//        ]);
//        $this->assertNull(Auth::user());
//
//        //
//        $response=$this->post('/login',['email'=>$user->email,
//            'password'=>'secret']);
//        $response->assertStatus(302);
//        $response->assertRedirect('/register');
//        $this->assertNull(Auth::user());

        //


    }

}