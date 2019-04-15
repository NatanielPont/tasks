<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 15/04/19
 * Time: 16:14
 */

namespace Tests\Unit\listeners\tasks_logs_events;


use App\Log;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AllTaskLogTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function task_completed_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));
        $listener = new \App\Listeners\LogTaskCompleted();
        $listener->handle(new \App\Events\TaskCompletedEvent($task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"s'ha completat la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'Completar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals((boolean)$log->old_value,false);
        $this->assertEquals($log->new_value,true);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'lock_open');
        $this->assertEquals($log->color,'green');
    }

    /**
     * @test
     */
    public function task_create_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));
        $listener = new \App\Listeners\LogTaskCreate();
        $listener->handle(new \App\Events\TaskCreateEvent($task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha creat la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'Crear');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,'');
        $this->assertEquals($log->new_value,$task->name);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'fiber_new');
        $this->assertEquals($log->color,'#339966');
    }

    /**
     * @test
     */
    public function task_destroy_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));
        $listener = new \App\Listeners\LogTaskDestroy();
        $listener->handle(new \App\Events\TaskDestroyEvent($task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha eliminat la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'Eliminar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,$task);
        $this->assertEquals($log->new_value,"");
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'delete_forever');
        $this->assertEquals($log->color,'#B40404');
    }
    /**
     * @test
     */
    public function task_uncompleted_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));
        $listener = new \App\Listeners\LogTaskUncompleted();
        $listener->handle(new \App\Events\TaskUncompletedEvent($task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha marcat com a pendent 'Comprar pa'");
        $this->assertEquals($log->action_type,'Descompletar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,true);
        $this->assertEquals($log->new_value,0);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'lock_open');
        $this->assertEquals($log->color,'orange');
    }

    /**
     * @test
     */
    public function task_update_log_has_been_created()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));
        $listener = new \App\Listeners\LogTaskUpdate();
        $listener->handle(new \App\Events\TaskUpdateEvent($task,$task,$user));
        // 3 ASSERT
        // Test log is inserted
        $log  = Log::find(1);
        $this->assertEquals($log->text,"S'ha modificat la tasca 'Comprar pa'");
        $this->assertEquals($log->action_type,'Modificar');
        $this->assertEquals($log->module_type,'Tasques');
        $this->assertEquals($log->user_id,$user->id);
        $this->assertEquals($log->old_value,$task);
        $this->assertEquals($log->new_value,$task);
        $this->assertEquals($log->loggable_id,$task->id);
        $this->assertEquals($log->loggable_type,Task::class);
        $this->assertEquals($log->icon,'edit');
        $this->assertEquals($log->color,'#6699ff');
    }



}
