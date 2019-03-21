<?php
namespace Tests\Feature\Api;

use App\Events\TaskCompletedEvent;
use App\Events\TaskUncompletedEvent;
use App\Events\TaskUpdateEvent;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 2/10/18
 * Time: 20:40
 */
class CompletedTaskControllerTest extends TestCase {
    use RefreshDatabase,CanLogin;
    /**
     * @test
     */
    public function can_complete_a_task()
    {
        $this->withoutExceptionHandling();
        $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        Event::fake();

        $response = $this->json('POST','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals($task->completed, true);
        Event::assertDispatched(TaskCompletedEvent::class, function ($event) use ($task) {
            return $event->task->is($task);
        });
    }
    /**
     * @test
     */
    public function cannot_complete_a_unexisting_task()
    {
        $this->login('api');
        $response = $this->json('POST','/api/v1/completed_task/1');
        //3 Assert
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function can_uncomplete_a_task()
    {
        $this->login('api');
        $task= Task::create([
            'name' => 'comprar pa',
            'completed' => true
        ]);
        Event::fake();

        //2
        $response = $this->json('DELETE','/api/v1/completed_task/' . $task->id);
        $response->assertSuccessful();
        $task = $task->fresh();
        $this->assertEquals((boolean) $task->completed, false);
        Event::assertDispatched(TaskUncompletedEvent::class, function ($event) use ($task) {
            return $event->task->is($task);
        });
    }
    /**
     * @test
     */
    public function cannot_uncomplete_a_unexisting_task()
    {
        $this->login('api');
        $response= $this->delete('/api/v1/completed_task/1');
        $response->assertStatus(404);
    }
}
