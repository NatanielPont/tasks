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

    /**
     * @test
     */
    public function can_add_vue_tasks()
    {

        $this->withoutExceptionHandling();
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tasks.store');
        $response=$this->post('/tasks',[
            'name'=>'Comprar llet',
        ]);
        $response->assertStatus(302);
//        $response->assertSuccessful();

        $this->assertDatabaseHas('tasks',['name'=>'Comprar llet']);

    }
    /**
     * @test
     */
    public function can_remove_vue_tasks()
    {
        $this->withoutExceptionHandling();
        initialize_roles();
        $user=$this->login();
        $user->givePermissionTo('tasks.destroy');
        $task=Task::create([
            'name'=>'Comprar llet']);
        $response=$this->delete('/tasks/'.$task->id);
        $response->assertStatus(302);
//        $response->assertSuccessful();
//        $response->assertViewIs('tasks_vue');
        $this->assertDatabaseMissing('tasks',['name'=>'Comprar llet']);


    }

}