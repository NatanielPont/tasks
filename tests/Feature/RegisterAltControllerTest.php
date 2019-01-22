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

class RegisterAltControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_register_a_user()
    {
        $this->withoutExceptionHandling();
        // Afegir register_alt a fitxer routers/web.php
        // Afegir Controller RegisterAltController i metode store
        // Dins del store:
        // 1) Objecte Request per la validació
        // 2) User::Create
        // 3) Login
        // 4) Redirect a /home
        $this->assertNull(Auth::user());
        // Execution
        $response = $this->post('/register_alt', $user = [
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/home');
//        dd(Auth::user());
        $this->assertNotNull(Auth::user());
        // Comprovat s'ha creat el usuari
        $this->assertEquals($user['email'],Auth::user()->email);
        $this->assertEquals($user['name'],Auth::user()->name);
        $this->assertTrue(Hash::check($user['password'],Auth::user()->password));
//        $this->assertEquals();


    }

}