<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    public function index($receiverId = null)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        $messages = [];
        if ($receiverId) {
            $messages = Message::where(function ($query) use ($receiverId) {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $receiverId);
            })->orWhere(function ($query) use ($receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', Auth::id());
            })->orderBy('created_at', 'asc')
                ->take(20)
                ->get();
        }

        return view('front.mesajlar', compact('users', 'messages'));
    }

    public function sendMessage(Request $request)
    {

        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'Message sent', 'message' => $message]);
    }

    public function fetchMessages($receiverId)
    {
        $currentUserId = Auth::id();

        $sentMessages = Message::where('sender_id', $currentUserId)
            ->where('receiver_id', $receiverId)
            ->orderBy('created_at', 'asc')
            ->take(20)
            ->get();

        $receivedMessages = Message::where('sender_id', $receiverId)
            ->where('receiver_id', $currentUserId)
            ->orderBy('created_at', 'asc')
            ->take(20)
            ->get();

        $messages = $sentMessages->merge($receivedMessages)->sortBy('created_at');

        return response()->json($messages->values());
    }

    public function saveUserSession(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'receiver_name' => 'required|string',
            'receiver_image' => 'required|string',
        ]);

        session([
            'receiver_id' => $request->receiver_id,
            'receiver_name' => $request->receiver_name,
            'receiver_image' => $request->receiver_image,
        ]);

        return response()->json(['status' => 'User session saved']);
    }
}
