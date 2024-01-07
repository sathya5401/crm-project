<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Additional Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding-top: 2%; 
            margin-top: 0; 
        }

        .btn-primary {
            background-color: #007bff; 
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .email-container {
            display: flex;
            justify-content: center;
            align-items: flex-start; 
            padding-top: 20px; 
            height: auto; 
        }

        .email-form {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .flex-row {
            display: flex;
            justify-content: space-between; /* Adjusted for alignment */
            align-items: center; /* Align items vertically */
        }

        .flex-row h4 {
            margin-bottom: 0; /* Remove margin to align properly */
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
    <section class="container-fluid bg-purple">
        <div class="container" style="margin-bottom: 2%;">
            <div class="row">
                <div class="col-12 flex-row">
                    <h4>Create New Email</h4>
                    <a href="{{ url('marketing/home') }}" class="btn btn-light">Back</a>
                </div>
            </div>
        </div>
    </section>
    <div class="email-container">
        <div class="email-form">
            <h4>Email</h4>
            <form method="POST" action="{{ route('send.email') }}" enctype="multipart/form-data">
                @csrf
                <!-- Category Selection -->
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="all">All Categories</option>
                        <option value="all">All Users</option>
                        <option value="upstream">Upstream Customers</option>
                        <option value="midstream">Midstream Customers</option>
                        <option value="downstream">Downstream Customers</option>
                    </select>
                </div>

                <!-- Subject -->
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" class="form-control" required />
                </div>

                <!-- Message -->
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" class="form-control" required></textarea>
                </div>

                <!-- Attachment -->
                <div class="form-group">
                    <label for="attachment">Attachment:</label>
                    <input type="file" name="attachment" id="attachment" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>

