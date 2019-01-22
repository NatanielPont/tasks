<?php
//psr-4
namespace Tests\Feature;

use App\Task;

//sufix as + alias;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
{
    //refresh database
    use RefreshDatabase,CanLogin;


    /**
     * A basic test example.
     * @test
     */
    public function can_show_tasks()
    {
        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //302 comprovar que es redirecciona
        //Prepare
       create_example_tasks();
        $this->login('api');
//        $user->givePermissionTo('tasks.show');
//        $this->login();


        //Execute
        $response=$this->get('/tasks');
//        dd($response);

        //Assert
        $response->assertSuccessful();
        $response->assertSee('Tasques');
        $response->assertSee('Comprar pa');
        $response->assertSee('Comprar llet');
        $response->assertSee('Estudiar php');

        //comprovar que es veuen les tasques q hi ha en la bd
        //preparar la bd a prepare

    }

    /**
     * @test
     */
    public function can_store_task()
    {
        $this->login();
        $response = $this->post('/tasks',[
            'name' => 'Comprar llet'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks',['name' => 'Comprar llet']);
    }
    /**
     * @test
     */
    public function cannot_delete_an_unexisting_task()
    {
        $this->login();
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->login();
        $task = Task::create([
            'name' => 'Comprar llet'
        ]);
        $response = $this->delete('/tasks/' . $task->id);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',['name' => 'Comprar llet']);
    }
    /**
     * @test
     */
    public function can_edit_a_task()
    {
        $this->login();
        $task = Task::create([
            'name' => 'asdasdasd',
            'completed' => false
        ]);
        $response = $this->put('/tasks/' . $task->id,$newTask = [
            'name' => 'Comprar pa',
            'completed' => true
        ]);
        $response->assertStatus(302);
        $task = $task->fresh();
        $this->assertEquals($task->name,'Comprar pa');
        $this->assertEquals($task->completed,true);
    }
    /**
     * @test
     */
    public function cannot_edit_an_unexisting_task()
    {
        $this->login();
        $response = $this->put('/tasks/1',[]);
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_show_edit_form()
    {
        $this->login();
        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => false
        ]);
        $response = $this->get('/task_edit/' . $task->id);
        $response->assertSuccessful();
        $response->assertSee('Comprar pa');
    }
    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
        $this->login();
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }
}
