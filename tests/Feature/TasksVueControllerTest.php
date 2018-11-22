<?php

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksVueControllerTest extends TestCase{
    use RefreshDatabase,CanLogin;
    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
        $this->withoutExceptionHandling();
        $this->login();

        //prepare
        create_example_tasks();

        //execute
        $response=$this->get('/tasks_vue');

        //assert
        $response->assertSuccessful();

        $response->assertViewIs('tasks_vue');
        $response->assertViewHas('tasks',Task::all());
//        $response->
//        $response->assertSee('Comprar pa','Comprar llet');
    }

}