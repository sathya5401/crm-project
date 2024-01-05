<!DOCTYPE html>
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
    <!-- styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .btn-back {
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            margin-right: 10px;
        }

        select, textarea {
            margin-bottom: 10px;
        }

        .comments-section {
            margin-top: 1%;
            /* background-color: #e9ecef; Light Gray Background */
            padding: 20px;
            border-radius: 8px;
        }

        .comment {
            background-color: #ffffff; /* White Background */
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ced4da; /* Border Color */
            border-radius: 4px;
        }

        button {
            background-color: #007bff; /* Blue Button Color */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')

    @section('content')
        <div class="container">
            <a href="{{ url('/inquiry') }}" class="btn btn-light btn-back">Back</a>
            <h1>Inquiry Details</h1>
            <p><strong>Name:</strong> {{ $inquiry->name }}</p>
            <p><strong>Email:</strong> {{ $inquiry->email }}</p>
            <p><strong>Message:</strong> {{ $inquiry->message }}</p>

            @if (Auth::user()->is_admin === 0)
            <form method="POST" action="{{ route('inquiry.updateStatus', $inquiry->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="status" class="col-2 col-form-label">Status:</label>
                    <div class="col-6">
                        <select name="status" id="status" class="form-control" required>
                            <option value="new" @if($inquiry->status == 'new') selected @endif>New</option>
                            <option value="in-progress" @if($inquiry->status == 'in-progress') selected @endif>In-progress</option>
                            <option value="completed" @if($inquiry->status == 'completed') selected @endif>Completed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            @endif

            @if (Auth::user()->is_admin === 1)
                <p><strong>Status:</strong> {{ $inquiry->status }}</p>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="container comments-section">
            <h2>Comments Section</h2>

            @foreach ($remarks as $remark)
                <div class="comment">
                    <strong>User:</strong> {{ $remark->comment }}
                </div>
            @endforeach

            @if (Auth::check())
                <form method="POST" action="{{ route('remarks.store', $inquiry->id) }}" style="margin-bottom: 1%;">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Add Comment</label>
                        <textarea name="comment" id="comment" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit Comment</button>
                </form>
            @endif
        </div>
    @endsection
</body>
</html>
