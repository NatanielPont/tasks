<?php
//psr-4
namespace Tests\Feature;

use App\Task;

//sufix as + alias;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasquesControllerTest extends TestCase
{
    //refresh database
    use RefreshDatabase,CanLogin;


    /**
     * A basic test example.
     * @test
     */
    public function can_index_tasques()
    {
        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //302 comprovar que es redirecciona
        //Prepare
       create_example_tasks();
        initialize_roles();
        $user=$this->login('');
        $user->givePermissionTo('user.tasks.index');
//        $this->login();


        //Execute
        $response=$this->get('/tasques');
//        dd($response);

        //Assert
        $response->assertSuccessful();
//        $response->assertSee('Tasques');
        $response->assertSee('Comprar pa');
        $response->assertSee('Comprar llet');
        $response->assertSee('Estudiar php');

        //comprovar que es veuen les tasques q hi ha en la bd
        //preparar la bd a prepare

    }

    /**
     * A basic test example.
     * @test
     */
    public function guest_user_can_index_tasques()
    {
        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //302 comprovar que es redirecciona
        //Prepare
        create_example_tasks();
//        initialize_roles();
        $user=$this->login('');

//        $user->giveRo('user.tasks.index');
//        $this->login();


        //Execute
        $response=$this->get('/tasques');
//        dd($response);

        //Assert
        $response->assertSuccessful();
//        $response->assertSee('Tasques');
        $response->assertSee('Comprar pa');
        $response->assertSee('Comprar llet');
        $response->assertSee('Estudiar php');

        //comprovar que es veuen les tasques q hi ha en la bd
        //preparar la bd a prepare

    }

    /**
     * @test
     */
    public function can_store_tasques()
    {
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
    public function can_delete_task()
    {
        $this->login();
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
    public function cannnot_delete_an_unexisting_task()
    {
        $this->login();
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }



    /**
     * @test
     */
    public function can_edit_a_task()
    {
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tasks.update');
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
//        $this->withoutExceptionHandling();
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tasks.update');
        $task= [
            'name'=>'Comprar pa',
            'completed'=> true,
            'description'=>'A',
            'user_id'=>1
        ];
        $response = $this->put('/tasks/1',$task);
        $response->assertStatus(404);

    }

    /**
     * @test
     */
    public function can_show_edit_form()
    {
        $this->withoutExceptionHandling();
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tasks.update');
        $task = Task::create( [
            'name'=>'Comprar pa',
            'completed'=> true,
            'description'=>'A',
            'user_id'=>1
        ]);
//        dd($task);
        $response = $this->get('/task_edit/' . $task->id);
        $response->assertSuccessful();
        $response->assertSee('Comprar pa');

    }
    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
        $this->withoutExceptionHandling();
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tasks.update');
        $response = $this->get('/task_edit/1',['name'=>'pep']);
        $response->assertStatus(404);
    }


}