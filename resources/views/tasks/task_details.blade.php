<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
            padding: 50px;
        } */
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #6c757d;
        }
        th {
            width: 150px;
            text-align: right;
            color: #495057;
        }
        td {
            color: #343a40;
        } 
        .btn-back {
            margin-top: 10px;
        }

        .comments-div {
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f9fa;
            max-height: 270px;  
        }

        .comments-display{
            margin-bottom: 10px; 
            padding: 10px; 
            border: 1px solid #ced4da; 
            border-radius: 5px; 
            background-color: #ffffff;
        }

        .comment-btn {
            background-color: #007bff; 
            color: #ffffff; 
            padding: 5px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer;
        }

        .comment-input {
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ced4da; 
            border-radius: 5px;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
        <div class="container">
            <h2>Task Details</h2>
            <table class="table">
                <tr>
                    <th>Owner:</th>
                    <td>{{ $task->owner }}</td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td>{{ $task->contact }}</td>
                </tr>
                <tr>
                    <th>Due Date:</th>
                    <td>{{ $task->due_date }}</td>
                </tr>
                <tr>
                    <th>Subject:</th>
                    <td>{{ $task->subject }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $task->descrip }}</td>
                </tr>
                <tr>
                    <th> Assigned: </th>
                    <td> {{ optional($task->assignedUser)->name }} </td>
                </tr>
            </table>
            <div style="margin-top: 20px;">
                @if ($task->comments->isNotEmpty())
                    <h3 style="color: #6c757d;">Comments</h3>
                    <div class="comments-div">
                        @foreach($task->comments as $comment)
                            <div class="comments-display">
                                <strong style="color: #007bff;">{{ $comment->user->name }}:</strong>
                                <span style="color: #495057;">{{ $comment->body }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No comments available.</p>
                @endif
            </div>
            <form action="{{ route('comments.store') }}" method="post" style="margin-top: 20px;">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                
                <div style="margin-bottom: 10px;">
                    <label for="comment" style="display: block; color: #495057; font-weight: bold;">Add a Comment:</label>
                    <textarea class="comment-input" name="body" id="comment" cols="30" rows="2"></textarea>
                </div>

                <button class="comment-btn" type="submit">Add Comment</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-back">Back</a>
        </div>
    @endsection
</body>
</html>
