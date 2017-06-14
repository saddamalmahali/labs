<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Pusher\Facades\Pusher as LaravelPusher;
use App\Chat;

class ChatController extends Controller
{
    public function getUserConversationById(Request $request)
    {
        $userId = $request->input('id');
        $authUserId = $request->user()->id;
        $chats = Chat::whereIn('sender_id', [$authUserId, $userId])
                ->whereIn('receiver_id', [$authUserId, $userId])
                ->orderBy('created_at', 'desc')
                ->get();
        
        return response(['data'=>$chats], 200);
    }

    public function ChatSave(Request $request){
        $sender_id = $request->user()->id;
        $receiver_id = $request->input('receiver_id');
        $chat = $request->input('chat');
        $data = [
            'sender_id'=> $sender_id,
            'receiver_id'=>$receiver_id,
            'chat'=>$chat,
            'read'=>1
        ];
        $saved = Chat::create($data);
        $finalData = Chat::where('id', $saved->id)->first();
        LaravelPusher::trigger('chat_channel', 'chat_saved', ['message'=>$finalData]);
        return response(['data'=>$finalData], 201);
    }
}
