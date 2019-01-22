<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 26/10/18
 * Time: 16:15
 */

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

//use App\User;
//use http\Env\Request;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Support\Facades\Auth;
//use Tests\TestCase;

class LoggedUserTasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function can_list_logged_user_tasks()
    {
//        $this->withoutExceptionHandling();
        $user = $this->loginAsSuperAdmin();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $tasks = collect([$task1,$task2,$task3]);
        $user->addTasks($tasks);
        $response = $this->get('/user/tasks');
        $response->assertSuccessful();
        $response->assertViewIs('tasks.user.index');
        $response->assertViewHas('tasks');
        $response->assertViewHas('uri');
    }
    /**
     * @test
     */
    public function manager_can_list_logged_user_tasks()
    {
        $user = $this->loginAsTaskManager();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $tasks = collect([$task1,$task2,$task3]);
        $user->addTasks($tasks);
        $response = $this->get('/user/tasks');
        $response->assertSuccessful();
        $response->assertViewIs('tasks.user.index');
        $response->assertViewHas('tasks');
        $response->assertViewHas('uri');
    }

    /**
     * @test
     */
    public function cannot_list_logged_user_tasks_if_user_is_regular_user()
    {
//        $this->withoutExceptionHandling();
        $this->login();
        $response = $this->json('GET','/user/tasks');
        $response->assertStatus(403);
    }
    /**
     * @test
     */
    public function cannot_list_logged_user_tasks_if_user_is_not_logged()
    {
        $response = $this->json('GET','/user/tasks');
        $response->assertStatus(401);
    }
}
