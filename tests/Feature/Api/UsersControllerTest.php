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
    use RefreshDatabase,CanLogin;



    /**
     * @test
     */
    public function can_list_users()
    {
        $this->withoutExceptionHandling();
        $user=factory(User::class)->create([
            'name'=> 'hai',
            'email'=> 'hai@mail.com'
        ]);
        $user2=factory(User::class)->create([
            'name'=> 'hai',
            'email'=> 'hai@mail.com'
        ]);
        $user3=factory(User::class)->create([
            'name'=> 'hai',
            'email'=> 'hai@mail.com'
        ]);
        $users=[$user,$user2,$user3];

        $response=$this->json('GET','api/v1/users');
        $response->assertSuccessful();
        $result=json_encode();


    }

}