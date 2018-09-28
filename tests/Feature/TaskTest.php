<?php
//psr-4
namespace Tests\Feature;

use App\Task;

//sufix as + alias;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    //refresh database
    use RefreshDatabase;


    /**
     * A basic test example.
     * @test
     */
    public function can_show_tasks()
    {
        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //Prepare
        Task::create([
            'name'=>'Comprar pa',
            'completed'=> true
        ]);
        Task::create([
            'name'=>'Comprar llet',
            'completed'=> false
        ]);
        Task::create([
            'name'=>'Estudiar php',
            'completed'=> false
        ]);

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
        $this->withoutExceptionHandling();
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
    public function can_delete_task()
    {
        $this->withoutExceptionHandling();
        //1
        $task=Task::create(['name'=>'Comprar llet']);


        //2
        $response=$this->delete('/tasks/'.$task->id);
        $response->assertStatus(302);
//        $response->assertSuccessful();

        //3
        $this->assertDatabaseMissing('tasks',['name'=>'Comprar llet']);




    }
    /**
     * @test
     */
    public function cannot_delete_task()
    {
        $this->withoutExceptionHandling();
        //


        //2
        $response=$this->delete('/tasks/1');
        $response->assertStatus(404);
//        $response->assertSuccessful();

        //3
//        $this->assertDatabaseMissing('tasks',['name'=>'Comprar llet']);




    }
}
