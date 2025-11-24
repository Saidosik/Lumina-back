<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Message;
use App\Models\Chat;

class ChatController extends Controller
{
    // after all this one need delete

    public function checkSender(Request $request){
        $senderId = auth()->check() ? auth()->id() : 12;
    
        return response()->json([
            'mess' => 'got id',
            'sender_id' => $senderId,
        ]);
    }   

    public function sendMessage(Request $request) { 
        $validated = $request->validate([
            'sender_id' => 'required',
            'chat_id' => 'required',
            'content' => 'required|string|max:1000',
        ]);

        $mess = Message::create($validated);
        if(!empty($mess)){
            return response()->json([
                'mess' => 'mess success',
            ]);
        }
        

        // Store message (if you have a messages table)
        // $message = Message::create([
        //     'content' => $request->content,
        //     'user_id' => auth()->id(), 
        // ]);


        return response()->json([
            'message' => 'Message sent succe1ssfully',
            'text' => $request->content . " " . $user,
            // 'message_id' => $message->id, 
        ], 201);
    }

    public function showMessage(Request $request){
        $validated = $request->validate([
            'chat_id' => 'required',
            'sender_id' => 'required',
        ]);

        $messages = Message::where('chat_id', $validated['chat_id'])->get();

        return response()->json([
            // 'message' => 'Message sent succe1ssfully',
            // 'text' => $request->content . " " . $user,
            'messages' => $messages,
            // 'message_id' => $message->id, 
            ], 200);
    }



    public function allChat(){
        $chat = Chat::all();
        if(!empty($chat)){
            return response()->json([
                    'mess' => "success",
                    'chats' => $chat
                ], 200);
        }
        return response()->json([
            'mess' => "error",
        ], 200);
    }

    public function createChat(Request $request){

        $validated = $request->validate([
            'creator_id' => 'required',
            'name' => 'required',
        ]);

        $chat = Chat::create($validated);
        if(!empty($chat)){
            return response()->json([
                    'mess' => "success",
                ], 200);
        }
        return response()->json([
            'mess' => "error",
        ], 200);
    }
}
