<?php
//psr-4
namespace Tests\Feature;

use App\Tag;
use App\Task;

//sufix as + alias;
use App\User;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasquesControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function guest_user_cannot_index_mobile()
    {
//        $this->withoutExceptionHandling();


        $response = $this->get('/mobile');
        $response->assertRedirect('/login');
    }
//    /**
//     * @test
//     */
//    public function regular_user_cannot_index_tasks()
//    {
//        $this->login();
//        $response = $this->get('/mobile');
//        $response->assertStatus(403);
//    }
    /**
     * @test
     */
    public function superadmin_can_index_mobile()
    {
        $this->withoutExceptionHandling();
//        create_example_tasks_with_tags();
        $user  = $this->loginAsSuperAdmin();
        $response = $this->get('/mobile');
        $response->assertSuccessful();
        $response->assertViewIs('mobile.index');

    }

    /**
     * @test
     */
    public function task_manager_can_index_mobile()
    {
        $this->withoutExceptionHandling();
//        create_example_tasks();
        $this->loginAsTaskManager();
        $response = $this->get('/mobile');
        $response->assertSuccessful();
        $response->assertViewIs('mobile.index');
//        $response->assertViewHas('tasks', function($tasks) {
//            return count($tasks)===3 &&
//                $tasks[0]['name']==='Comprar pa' &&
//                $tasks[1]['name']==='Comprar llet' &&
//                $tasks[2]['name']==='Estudiar php';
//        });
    }
    /**
     * @test
     */
    public function tasks_user_can_index_mobile()
    {
//        create_example_tasks();
        $user = $this->loginAsTasksUser();
//        Task::create([
//            'name' => 'Tasca usuari logat',
//            'completed' => false,
//            'description' => 'Jorl',
//            'user_id' => $user->id
//        ]);
        $response = $this->get('/mobile');
        $response->assertSuccessful();
        $response->assertViewIs('mobile.index');
//        $response->assertViewHas('tasks', function($tasks) {
////            dd($tasks);
//            return count($tasks)===4 &&
//                $tasks[3]['name']==='Tasca usuari logat';
//        });
//        $response->assertViewHas('users');
//        $response->assertViewHas('uri');
    }

}
