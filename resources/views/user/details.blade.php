<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Head content goes here -->
    <!-- Add your CSS styles here -->
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
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
        <div class="container">
            <h2>User Details</h2>
            <table class="table">
                <tr>
                    <th>Name:</th>
                    <td> {{ $user->name }} </td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td> {{ $user->email }} </td>
                </tr>
                <tr>
                    <th>Role:</th>
                    <td> {{ $user->role }}</td>
                </tr>
                <tr>
                    <th>Branch:</th>
                    <td>{{ $user->branch }} </td>
                </tr>
                <tr>
                    <th>Phone Number:</th>
                    <td> {{ $user->phone_number }}</td>
                </tr>
            </table>
            <!-- <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-back">Back</a> -->
        </div>
    @endsection
</body>
</html>
