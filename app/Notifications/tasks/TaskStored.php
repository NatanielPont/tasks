<?php
namespace App\Notifications\tasks;
use App\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
/**
 * Class SimpleNotification.
 *
 * @package App\Notifications
 */
class TaskStored extends Notification implements ShouldQueue
{
    use Queueable;
    public $task;
    /**
     * SimpleNotification constructor.
     * @param $title
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return $this->task->map();
    }
}