<?php
// app/Http/Controllers/MessageController.php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $currentUser = Auth::user();

        return view('messages.index', compact('messages', 'users', 'currentUser'));
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
    public function markAsRead(Message $message)
    {
        if ($message->receiver_id === auth()->id()) {
            $message->update(['read_at' => now()]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }
}