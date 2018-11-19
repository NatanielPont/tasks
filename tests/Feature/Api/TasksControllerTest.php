<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 11/10/18
 * Time: 19:24
 */

namespace Tests\Feature\Api;


use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase,CanLogin;

    //crud= 'cru'-> create retrieve update delete
    //bread= 'pa'-> browser read edit add delete

    /**
     * @test
     */
    public function can_show_a_task()
    {
        $this->withoutExceptionHandling();
        initialize_roles();
        $user=$this->login('api');
        $user->givePermissionTo('tasks.show');
        //http://tasks.test/api/v1
        //Http-> get, post,put, delete

        $task=factory(Task::class)->create(['name'=>'Comprar pa']);

        $response=$this->get('/api/v1/tasks/'.$task->id);
//        dd(json_decode($response->getContent()));
        $result=json_decode($response->getContent());
        $response->assertSuccessful();
//        dd($result);
        $this->assertEquals($task->name,$result->name);
        $this->assertEquals($task->completed,(boolean)$result->completed);
//        dd($result->name);
//        dd($response->getContent());
        $response->assertSuccessful();
    }
    /**
     * @test
     */
    public function regular_user_cannot_show_a_task()
    {
        $this->login('api');
        $task = factory(Task::class)->create();
        $response = $this->json('GET','/api/v1/tasks/' . $task->id);
        $response->assertStatus(403);
    }


    /**
     * @test
     */
    public function superadmin_can_show_a_task()
    {
        $user = $this->login('api');
        $user->admin = true;
        $user->save();
        $task = factory(Task::class)->create();
        $response = $this->json('GET','/api/v1/tasks/' . $task->id);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean) $result->completed);
    }

    /**
     * @test
     */
    public function task_manager_can_show_a_task()
    {
        $this->withoutExceptionHandling();

        initialize_roles();
        $user=$this->login('api');
        $user->assignRole('TaskManager');
        //add role taskmanager to user
        //http://tasks.test/api/v1
        //Http-> get, post,put, delete

        $task=factory(Task::class)->create(['name'=>'Comprar pa']);

        $response = $this->json('GET','/api/v1/tasks/' . $task->id);
        $result = json_decode($response->getContent());

        $response->assertSuccessful();
//        dd($result);
        $this->assertEquals($task->name,$result->name);
        $this->assertEquals($task->completed,(boolean)$result->completed);
//        dd($result->name);
//        dd($response->getContent());
        $response->assertSuccessful();
    }




    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->login('api');
        $this->withoutExceptionHandling();
        $task=factory(Task::class)->create();
        $response=$this->delete('/api/v1/tasks/'.$task->id);
        $result=json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('',$result);
//        $this->assertDatabaseMissing('tasks',$task);
        $this->assertNull(Task::find($task->id));

    }
    /**
     * @test
     */
    public function can_create_task()
    {
        $this->login('api');
//        $this->withoutExceptionHandling();
        $response=$this->post('/api/v1/tasks/',[
            'name'=>'Comprar pa',
            'completed'=>false
        ]);
        $result=json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertNotNull(Task::find($result->id));
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertFalse($result->completed);

    }

    /**
     * @test
     */
    public function can_list_tasks()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        create_example_tasks();
        $response = $this->json('GET','/api/v1/tasks');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3,$result);
        $this->assertEquals('Comprar pa', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);
        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertFalse((boolean) $result[1]->completed);
        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean) $result[2]->completed);
    }

    /**
     * @test
     */
    public function can_edit_task()
    {
        $this->login('api');
        $this->withoutExceptionHandling();
        $task=factory(Task::class)->create([ 'name'=>'prsdfgsd',
            'completed'=> false]);

        $response=$this->put('/api/v1/tasks/' . $task->id,$newTask=[
            'name'=>'Comprar pa',
            'completed'=> true
        ]);
        $result=json_decode($response->getContent());
        $response->assertSuccessful();
//        $response=$this->put('/api/v1/tasks/'.$task->id,$newTask=[
//            'name'=>'Comprar pa',
//            'completed'=> true
//        ]);
        $task=$task->fresh();
        $this->assertEquals($result->name,'Comprar pa');
        $this->assertEquals($result->completed,true);

//        $response->assertSuccessful();
//        $task->fresh();
//        $this->assertEquals($result->name,'Comprar pa');
//        $this->assertEquals($result->completed,true);




    }


    /**
     * @test
     */
    public function cannot_create_tasks_without_name()
    {
//        $this->withoutExceptionHandling();
        $response=$this->post('/api/v1/tasks/',[
            'name'=>''
        ]);
        $result=json_decode($response->getContent());
        //422, codi de fets invalids
        $response->assertStatus(422);


    }



}