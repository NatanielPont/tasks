<?php
namespace App\Events;
use App\Task;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class TaskCompletedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $task,$user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task,User $user)
    {
        $this->task = $task;
        $this->user = $user;

    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if (strlen($this->task->user_id)==0){
            $userID=$this->task->user_id;
        } else {
            $userID=Auth::user()->getAuthIdentifier();
        }
        return[
            new PrivateChannel('App.User.' . $userID),
            new PrivateChannel('Tasques'),
            new PrivateChannel('App.Log')
        ];
    }
}
