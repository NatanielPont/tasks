<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\ChatIndex;
use App\Http\Requests\push_subscription\PushSubscriptionDestroy;
use App\Http\Requests\push_subscription\PushSubscriptionUpdate;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

/**
 * Class ChatController.
 *
 * @package App\Http\Controllers\Tenant\Web
 */
class PushSubscriptionController extends Controller
{
    use ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function update(Request $request)
    {
        $this->validate($request, ['endpoint' => 'required']);
        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->key,
            $request->token
        );
    }

    public function destroy(Request $request)
    {
        $this->validate($request, ['endpoint' => 'required']);
        $request->user()->deletePushSubscription($request->endpoint);
        return response()->json(null, 204);
    }

}
