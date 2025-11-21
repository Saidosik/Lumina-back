<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request) { 
        $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    // Store message (if you have a messages table)
    // $message = Message::create([
    //     'content' => $request->content,
    //     'user_id' => auth()->id(), 
    // ]);

    return response()->json([
        'message' => 'Message sent succe1ssfully',
        // 'message_id' => $message->id, 
        ], 201);
    }
}
