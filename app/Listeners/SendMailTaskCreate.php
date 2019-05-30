<?php
namespace App\Listeners;
use App\Mail\TaskCreate;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class SendMailTaskCreate implements ShouldQueue
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
        $subject = $event->task->subject();
        $user = User::find($event->task['user_id']);
        if (!$user){
            $user=Auth::user();
        }
        Mail::to($user)
            ->cc(config('tasks.manager_email'))
            ->send((new TaskCreate($event->task))->subject($subject));
    }
}
