<?php
namespace App\Listeners;
use App\Events\Changelog;
use App\Log;
use App\Task;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class LogTaskUpdate
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
        $log=Log::create([
            'text' => "S'ha modificat la tasca '".$event->oldTask->name ."'" ,
            'time' =>Carbon::now(),
            'action_type' => 'Modificar',
            'module_type'=>'Tasques',
            'icon' => 'edit',
            'color' => '#6699ff',
            'user_id' => $event->task->user_id,
            'loggable_id' => $event->task->id,
            'loggable_type' => Task::class,
            'old_value' => $event->oldTask,
            'new_value' => $event->task
        ]);
        event(new Changelog($log, $event->user->map()));

    }
}
