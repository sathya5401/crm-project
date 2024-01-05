<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        .flex {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
        }

        .bg-purple {
            background-color: #D8DCFC;
        }

        .btn {
            background-color: #000;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .card-row {
            background-color: #FFFFFF;
            width: 100%;
            margin-top: 3%;
        }

        .flex-inputs {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
@extends('layouts.sidebar')
@section('content')
    <section class="container-fluid bg-purple">
        <div class="container" style="padding-top: 3%; margin-top: 3%">
            <div class="row" style="margin-bottom: 3%;">
                <div class="col-12 flex">
                    <div>
                        <h4>New Inquiry</h4>
                    </div>
                </div>
            </div>
            <div class="row card-row">
                <div class="col-md-6">
                    <div class="card-body" style="padding: 2%;">
                        <!-- <h5> New Inquiry </h5> -->
                        <form method="POST" action="{{ url('/inquiry/new') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <select class="form-control" name="Status" id="Status" required>
                                    <option value="new"> New </option>
                                    <option value="in-progress"> In-progress </option>
                                    <option value="completed"> Completed </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Inquiry</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Add any additional content for the second column here -->
                </div>
            </div>
        </div>
    </section>
@endsection
</body>
</html>
