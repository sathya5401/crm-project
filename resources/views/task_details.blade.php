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
            <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-back">Back</a>
        </div>
    @endsection
</body>
</html>
