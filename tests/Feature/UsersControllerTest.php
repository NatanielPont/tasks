<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 11/10/18
 * Time: 19:24
 */

namespace Tests\Feature;


use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;
    /** @test */
    public function can_list_users()
    {
        $this->withoutExceptionHandling();
        $this->login();
        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa Parda Jeans',
            'email' => 'pepaparda@jeans.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@dibus.com'
        ]);

        $response = $this->json('GET','/users');
        $response->assertSuccessful();
        $response->assertViewIs('users.index');
        $response->assertSee('Pepe Pardo Jeans');
        $response->assertSee('pepepardo@jeans.com');
        $response->assertSee('Pepa Parda Jeans');
        $response->assertSee('pepaparda@jeans.com');
        $response->assertSee('Pepa Pig');
        $response->assertSee('pepapig@dibus.com');
    }

}
