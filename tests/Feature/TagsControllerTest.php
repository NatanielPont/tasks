<?php
//psr-4
namespace Tests\Feature;

use App\Task;

//sufix as + alias;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    //refresh database
    use RefreshDatabase,CanLogin;


    /**
     * A basic test example.
     * @test
     */
    public function can_show_tags()
    {
//        $this->withoutExceptionHandling();
//        $this->assertTrue(true);
        //302 comprovar que es redirecciona
        //Prepare
       create_example_tags();
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tags.show');
//        $this->login();


        //Execute
        $response=$this->get('/tags');
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
    public function regular_user_cannot_show_tasks()
    {


    }

    /**
     * @test
     */
    public function can_store_task()
    {
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tags.store');
        $response=$this->post('/tags',[
            'name'=>'Comprar llet',
        ]);
        $response->assertStatus(302);
//        $response->assertSuccessful();

        $this->assertDatabaseHas('tags',['name'=>'Comprar llet']);




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
        $response=$this->delete('/tags/'.$task->id);
        $response->assertStatus(302);
//        $response->assertSuccessful();

        //3
        $this->assertDatabaseMissing('tags',['name'=>'Comprar llet']);




    }

    /**
     * @test
     */
    public function cannnot_delete_an_unexisting_task()
    {
        $this->login();
        $response = $this->delete('/tags/1');
        $response->assertStatus(404);
    }



    /**
     * @test
     */
    public function can_edit_a_task()
    {
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tags.update');
        $task = Task::create([
            'name' => 'asdasdasd',
            'completed' => false
        ]);
        $response = $this->put('/tags/' . $task->id,$newTask = [
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
        $user->givePermissionTo('tags.update');
        $task= [
            'name'=>'Comprar pa',
            'completed'=> true,
            'description'=>'A',
            'user_id'=>1
        ];
        $response = $this->put('/tags/1',$task);
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
        $user->givePermissionTo('tags.update');
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
        $user->givePermissionTo('tags.update');
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }


}