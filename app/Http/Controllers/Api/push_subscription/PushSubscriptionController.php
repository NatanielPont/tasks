<?php

namespace App\Http\Controllers\Api\push_subscription;

use App\Http\Requests\push_subscription\PushSubscriptionDestroy;
use App\Http\Requests\push_subscription\PushSubscriptionUpdate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PushSubscriptionController extends Controller
{
    public function update(PushSubscriptionUpdate $request)
    {
        $request->user()->updatePushSubscription(
            $request->endpoint,
            $request->key,
            $request->token
        );
    }

    public function destroy(PushSubscriptionDestroy $request)
    {
        $request->user()->deletePushSubscription($request->endpoint);
        return response()->json(null, 204);
    }
    //
}
