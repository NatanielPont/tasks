<?php
namespace Tests\Feature;

use App\Task;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 2/10/18
 * Time: 20:40
 */
class CompletedTaskControllerTest extends TestCase {
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    /**
     * @test
     */
    public function can_complete_a_task()
    {
        $task=Task::create([
            'name'=>'comprar pa',
            'completed'=> false
        ]);
        $response=$this->post('/completed_task/'.$task->id);
        $task=$task->fresh();
        $this->assertEquals($task->completed,true);
        $response->assertRedirect('/tasks');
        $response->assertStatus(302);

    }
    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        $task=Task::create([
            'name'=>'comprar pa',
            'completed'=> true
        ]);
        $response=$this->delete('/completed_task/'.$task->id);
        $task=$task->fresh();
        $this->assertEquals($task->completed,false);
        $response->assertRedirect('/tasks');
        $response->assertStatus(302);
//        $this->post('/completed_task/1');

    }
    /**
     * @test
     */
    public function cannot_complete_unnexisting_task_()
    {

        $response=$this->post('/completed_task/1');
        $response->assertStatus(404);

    }

}