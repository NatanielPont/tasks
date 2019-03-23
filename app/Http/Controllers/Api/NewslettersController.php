<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 23/03/19
 * Time: 4:27
 */

namespace App\Http\Controllers\Api;
use App\Http\Requests\newsletters\NewsletterStore;
use Log;
use Response;
use App\Http\Controllers\Controller;
use Newsletter;


class NewslettersController extends Controller
{
    /**
     * Store email in newsletter.
     *
     * @param NewsletterStore $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(NewsletterStore $request)
    {
        Log::debug('Subscribing user email: '. $request->email);
        $result = Newsletter::subscribePending($request->email);
        if ($result) {
            return $result;
        }
        return Response::json([
            'message' => 'User already registered',
        ], 423);
    }

}
