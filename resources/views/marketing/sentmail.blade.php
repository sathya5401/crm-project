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
<div class="d-flex justify-content-center align-items-center" style="height: 25vh;"> <!-- Wrapper with Flexbox -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Email Sent') }}</div>
                    <div class="card-body">
                        {{ __('Successfully sent email!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>
