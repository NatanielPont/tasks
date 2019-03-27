<?php
use App\Avatar;
use App\Events\TaskCreateEvent;
use App\Listeners\tasks\SendTaskStoredNotification;
use App\Notifications\tasks\TaskStored;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
class SendTaskStoredNotificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function sendTaskStoredNotification()
    {
//        $listener=new SendTaskStoredNotification();
//        $user = factory(User::class)->create();
//        $task = Task::create([
//            'name' => 'Pepito',
//            'user_id' => $user->id
//        ]);
//        $event=new \App\Events\TaskCreateEvent($task,$user);
//        Notification::fake();
//        $listener->handle($event);
//        Notification::assertSentTo($user,TaskStored::class,function ($notification,$channels) use ($task){
//            return $notification->task->id===$task->id;
//        });
        $listener = new SendTaskStoredNotification();
        $user = factory(User::class)->create();
        $task = Task::create([
            'name' => 'Pepito',
            'user_id' => $user->id
        ]);
        $event  = new TaskCreateEvent($task, $user);
        Notification::fake();
        $listener->handle($event);
        Notification::assertSentTo(
            $user,
            TaskStored::class,
            function ($notification, $channels) use ($task) {
                return $notification->task->id === $task->id;
            }
        );

    }
    /**
     * @test
     */
    public function map()
    {
        $avatar = Avatar::create([
            'url' => '/avatar.png',
        ]);
        $mappedAvatar = $avatar->map();
        $this->assertEquals($mappedAvatar['id'],1);
        $this->assertEquals($mappedAvatar['url'],'/avatar.png');
    }
}
