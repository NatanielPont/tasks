<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 18/04/19
 * Time: 2:20
 */

namespace App\Http\Controllers\Api\chat;


use App\Channel;
use App\ChatMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatMessageDestroy;
use App\Http\Requests\Chat\ChatMessageIndex;
use App\Http\Requests\Chat\ChatMessageStore;

class ChatMessageController extends Controller
{
    /**
     * Index
     *
     * @param ChatMessageIndex $request
     * @return mixed
     */
    public function index(ChatMessageIndex $request, Channel $channel)
    {
        return map_collection($channel->messages);
    }
    /**
     * Store
     *
     * @param ChatMessageStore $request
     * @return mixed
     */
    public function store(ChatMessageStore $request, Channel $channel)
    {
        $channel->addMessage($message = ChatMessage::create([
            'text' => $request->text
        ]));
        return $message;
    }
    /**
     * Destroy
     *
     * @param ChatMessageDestroy $request
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ChatMessageDestroy $request, Channel $channel, ChatMessage $message)
    {
        $message->delete();
        return $message;
    }

}
