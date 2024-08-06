<?php
// app/Http/Controllers/MessageController.php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::where('id', '!=', auth()->id())->get();

        return view('messages.index', compact('messages', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return redirect()->route('messages.index')->with('success', 'Message sent successfully.');
    }

    public function getUnreadMessages()
    {
        $unreadMessages = auth()->user()->unreadMessages()
            ->with('sender:id,name,email,usertype')
            ->latest()
            ->take(4)
            ->get();

        return response()->json($unreadMessages);
    }
}