<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 11/10/18
 * Time: 19:24
 */

namespace Tests\Feature\Api;


use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function can_list_users()
    {
        $this->withoutExceptionHandling();
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
        $this->actingAs($user1,'api');
        $response = $this->json('GET','/api/v1/users');
//        dd($response);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
//        dd($result);
        $this->assertEquals($result[0]->name,'Pepe Pardo Jeans');
        $this->assertEquals($result[0]->email,'pepepardo@jeans.com');
        $this->assertEquals($result[0]->gravatar,'https://www.gravatar.com/avatar/' . md5('pepepardo@jeans.com'));
        $this->assertEquals($result[1]->name,'Pepa Parda Jeans');
        $this->assertEquals($result[1]->email,'pepaparda@jeans.com');
        $this->assertEquals($result[1]->gravatar,'https://www.gravatar.com/avatar/' . md5('pepaparda@jeans.com'));
        $this->assertEquals($result[2]->name,'Pepa Pig');
        $this->assertEquals($result[2]->email,'pepapig@dibus.com');
        $this->assertEquals($result[2]->gravatar,'https://www.gravatar.com/avatar/' .  md5('pepapig@dibus.com'));
    }

}
