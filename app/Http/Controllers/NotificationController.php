<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 17/02/19
 * Time: 3:49
 */

namespace App\Http\Controllers;

use App\DatabaseNotification;
use App\Http\Requests\Changelog\ListChangelog;
use App\Http\Requests\Notifications\NotificationsIndex;
use App\Http\Requests\Notifications\UserNotificationsIndex;
use App\Log;
use App\User;
/**
 * Class ChangelogController.
 *
 * @package App\Http\Controllers\Tenant\Web
 */
class NotificationController extends Controller
{
    /**
     * NotificationsIndex.
     *
     * @param NotificationsIndex $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(UserNotificationsIndex $request)
    {
        $notifications = collect([]);
        $users = collect([]);
        if ($request->user()->can('notifications.index')) {
            $notifications = map_collection(DatabaseNotification::notifications());
            $users = map_simple_collection(User::all());
        }
        $userNotifications = $request->user()->notifications;
        return view('notifications.index', compact('userNotifications', 'notifications', 'users'));
    }

}
