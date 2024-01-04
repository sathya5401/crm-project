@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div>
            <a href="{{ url('/inquiry') }}" class="btn btn-light"> Back </a>
        </div>
        <h1>Inquiry Details</h1>
        <p><strong>Name:</strong> {{ $inquiry->name }}</p>
        <p><strong>Email:</strong> {{ $inquiry->email }}</p>
        <p><strong>Message:</strong> {{ $inquiry->message }}</p>
        @if ( (Auth::user()->is_admin) === 0)
        <form method="POST" action="{{ route('inquiry.updateStatus', $inquiry->id) }}" >
            @csrf
            @method('PUT')
            <label for="status">Status</label>
            <select name="status" id="status" value="{{$inquiry->status}}" required>
                <option value="new" @if($inquiry->status == 'new') selected @endif>New</option>
                <option value="in-progress" @if($inquiry->status == 'in-progress') selected @endif>In-progress</option>
                <option value="completed" @if($inquiry->status == 'completed') selected @endif>Completed</option>               
            </select>
            <button type="submit">Submit</button>
        </form>
        @endif
        @if ( (Auth::user()->is_admin) === 1)
        <p><strong>Status:</strong> {{ $inquiry->status }}</p>
        @endif
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <h2>Comments Section</h2>
        @foreach ($remarks as $remarks)
            <div class="comment">
                <strong> User: </strong> {{ $remarks->comment }}
            </div>
        @endforeach

        @if (Auth::check())
            <form method="POST" action="{{ route('remarks.store', $inquiry->id) }}">
                @csrf
                <label for="comment">Add Comment</label>
                <textarea name="comment" id="comment" required></textarea>
                <button type="submit">Submit Comment</button>
            </form>
        @endif
    </div>
@endsection