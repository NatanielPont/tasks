<?php
namespace App\Http\Controllers\Api\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notifications\HelloNotificationStore;
use App\Http\Requests\Notifications\NotificationsDestroy;
use App\Http\Requests\Notifications\NotificationsDestroyMultiple;
use App\Http\Requests\Notifications\NotificationsIndex;
use App\DatabaseNotification;
use App\Notifications\HelloNotification;

/**
 * Class NotificationsController.
 *
 * @package App\Http\Controllers\Api\Notifications
 */
class HelloNotificationController extends Controller
{
    /**
     * Index.
     *
     * @param HelloNotificationStore $request
     * @return mixed
     */
    public function store(HelloNotificationStore $request)
    {
        $request->user()->notify(new HelloNotification);
        return response()->json('Notification sent.', 201);
    }
}
