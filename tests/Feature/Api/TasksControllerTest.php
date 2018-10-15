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
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

    //crud= 'cru'-> create retrieve update delete
    //bread= 'pa'-> browser read edit add delete

    /**
     * @test
     */
    public function can_show_a_task()
    {
        $this->withoutExceptionHandling();
        //http://tasks.test/api/v1
        //Http-> get, post,put, delete
//        Task:create([
//            name=>'Comprar pa'
//    ]);

        $task=factory(Task::class)->create(['name'=>'Comprar pa']);

        $response=$this->get('/api/v1/tasks/'.$task->id);
//        dd(json_decode($response->getContent()));
        $result=json_decode($response->getContent());
        $response->assertSuccessful();
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
        $this->withoutExceptionHandling();
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
        create_example_tasks();
        
    }

    /**
     * @test
     */
    public function can_edit_task()
    {
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



}