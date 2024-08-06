@extends('template')

<div class="container">
    <h1>Messages</h1>
    
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMessageModal">New Message</button>
    
    <div class="row">
        <div class="col-md-12">
            <h2>Message History</h2>
            @foreach($messages as $message)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if($message->sender_id == Auth::id())
                                To: {{ $message->receiver->name }} <i>({{ $message->receiver->usertype }})</i>
                            @else
                                From: {{ $message->sender->name }} <i>({{ $message->sender->usertype }})</i>
                            @endif
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $message->created_at->diffForHumans() }}</h6>
                        <p class="card-text">{{ $message->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- New Message Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMessageModalLabel">New Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="receiver_id" class="form-label">To:</label>
                        <select class="form-select" id="receiver_id" name="receiver_id" required>
                            @foreach($users as $user)
                                @if($user->id != Auth::id())
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->usertype }})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Message:</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
