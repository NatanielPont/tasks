<?php
namespace App\Listeners\tasks;
//use App\Notifications\TaskStored;
use App\Notifications\tasks\TaskStored;
//use App\Notifications\TaskUncompleted;
use App\Notifications\tasks\TaskUncompleted;
use App\Task;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class SendNotificationTaskUncompleted
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
//        dd($event);
        if ($event->task->user){
            $user=$event->task->user;
        } else{
            $user=Auth::user();
        }
        $user->notify(new TaskUncompleted($event->task));
    }
}
