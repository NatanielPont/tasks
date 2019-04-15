<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 15/04/19
 * Time: 16:09
 */

namespace Tests\Unit\listeners\task_mail_events;


use App\Mail\TaskCompleted;
use App\Mail\TaskCreate;
use App\Mail\TaskDestroy;
use App\Mail\TaskUncompleted;
use App\Mail\TaskUpdate;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AllSendMailTaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function task_completed_mail_has_been_send()
    {
//        $this->withoutExceptionHandling();
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskCompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskCompleted();
        $listener->handle(new \App\Events\TaskCompletedEvent($task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskCompleted::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }

    /**
     * @test
     */
    public function task_create_mail_has_been_send()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskCompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskCreate();
        $listener->handle(new \App\Events\TaskCreateEvent($task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskCreate::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }

    /**
     * @test
     */
    public function task_destroy_mail_has_been_send()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskCompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskDestroy();
        $listener->handle(new \App\Events\TaskDestroyEvent($task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskDestroy::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }

    /**
     * @test
     */
    public function task_uncompleted_mail_has_been_send()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskUncompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskUncompleted();
        $listener->handle(new \App\Events\TaskUncompletedEvent($task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskUncompleted::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }

    /**
     * @test
     */
    public function task_updated_mail_has_been_send()
    {
        // 1 Preparar
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Comprar pa',
            'user_id' => $user->id
        ]);
        // Executar
//        event(new TaskCompleted($task));
        Mail::fake();
        $listener = new \App\Listeners\SendMailTaskUpdate();
        $listener->handle(new \App\Events\TaskUpdateEvent($task,$task,$user));
        // 3 ASSERT
        Mail::assertSent(TaskUpdate::class, function ($mail) use ($task, $user) {
            return $mail->task->is($task) &&
                $mail->hasTo($user->email) &&
                $mail->hasCc(config('tasks.manager_email'));
        });
    }

}
