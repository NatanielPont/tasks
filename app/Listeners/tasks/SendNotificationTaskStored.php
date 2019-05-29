<?php
namespace App\Listeners\tasks;
//use App\Notifications\TaskStored;
use App\Notifications\tasks\TaskStored;
use App\Task;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
class SendNotificationTaskStored
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->task->user->notify(new TaskStored($event->task));
    }
}
