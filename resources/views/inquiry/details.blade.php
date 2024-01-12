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
         /* body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        } */

        .bg-purple {
            background-color: #e0dcfc;
        }

        .table thead tr {
            background-color: #dc3545 !important;
            color: white;
        }
        .icons {
            display: flex;
            align-items: stretch;
            justify-content: center;
        }

        .container1 {
            margin-bottom: 5%;
            margin-top: 2%;
        }
        /* .container {
            margin-top: 1%;
        } */

        form {
            margin-top: 20px;
        }

        label {
            margin-right: 10px;
        }

        select {
            margin-bottom: 10px;
        }

        .comments-section {
            margin-top: 1%;
            margin-bottom: 2%;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff; /* White Background */
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
            margin-bottom: 10px;
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2%;
        }

        .inquiry-details {
            margin-top: 20px;
        }

        .grid-layout {
            display: grid;
            grid-template-columns: max-content 1fr; /* Adjust these values as needed */
            grid-gap: 8px; /* Reduced gap */
            align-items: start;
        }

        .grid-layout > div {
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
    <section class="container-fluid">
        <div class="container">
                <div class="header">
                    <h2 style="border-bottom: 1px solid #dee2e6; padding-bottom: 10px;">Inquiry Details</h2>
                    <a href="{{ url('/inquiry') }}" class="btn btn-light btn-back">Back</a>
                </div>
             
        <div>    
            <div class="inquiry-details grid-layout">
                <div><strong>Name:</strong></div>
                <div>{{ $inquiry->name }}</div>
                
                <div><strong>Email:</strong></div>
                <div>{{ $inquiry->email }}</div>

                <div><strong>Message:</strong></div>
                <div>{{ $inquiry->message }}</div>
            </div>
        </div>

            @if (Auth::user()->is_admin === 0)
                <form method="POST" action="{{ route('inquiry.updateStatus', $inquiry->id) }}" id="updateStatus">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <!-- Label -->
                        <label for="status" class="col-auto col-form-label">Status:</label>

                        <!-- Select Dropdown -->
                        <div class="col-md-3">
                            <select name="status" id="status" class="form-control" required>
                                <option value="new" @if($inquiry->status == 'new') selected @endif>New</option>
                                <option value="in-progress" @if($inquiry->status == 'in-progress') selected @endif>In-progress</option>
                                <option value="completed" @if($inquiry->status == 'completed') selected @endif>Completed</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            @endif

            @if (Auth::user()->is_admin === 1)
                <div class="inquiry-details grid-layout">
                    <div><strong>Status:</strong></div>
                    <div>{{ $inquiry->status }}</div>
                </div>
            @endif
        </div>

        <!-- Comments Section -->
        <div class="container comments-section">
            <h3>Comments Section</h3>
            
            @foreach ($remarks as $remark)
                <div class="comment">
                    <strong>
                        >
                    </strong> {{ $remark->comment }}
                </div>
            @endforeach

            @if (Auth::check())
                <form method="POST" action="{{ route('remarks.store', $inquiry->id) }}" style="margin-bottom: 1%;" id="comment">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Add Comment</label>
                        <textarea name="comment" id="comment" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit Comment</button>
                </form>
            @endif
                <script>
                    document.getElementById('comment').addEventListener('submit', function(event) {
                        alert('Comment added!');
                    });
                </script>
        </div>
    </section>
    @endsection
</body>
</html>

