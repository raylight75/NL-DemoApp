<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * ChatController
 */
class ChatController extends Controller
{
    /**
     * Show all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMessages()
    {
        $users = User::all();
        $messages = Message::with('user')->get()->take(-50);
        return view('layouts.messages', compact('messages', 'users'));
    }
    
    /**
     * sendMessage
     *
     * @param  mixed $request
     * @return void
     */
    public function sendMessage(Request $request)
    {
        $id = $request->userId;
        $message = $request->messages;
        //Simple validation for user and valid message
        $this->validate($request, [
            'userId' => 'required',
            'messages' => 'required'
        ]);        
        $message = new Message();
        $message->user_id = $request->userId;
        $message->message = $request->messages;
        $message->save();
        $time = date('H:i:s', strtotime($message->created_at));        
        $username = User::where('id',  $id)->first();
        return response()->json(array(
            'message' => $message,
            'username' => $username,
            'time' => $time,            
        ));        
    }
}
