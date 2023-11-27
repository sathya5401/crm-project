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

<!-- styles -->
<style>
.detailscontainer{
    background-color:#D8DCFC;
    display: flex;
    align-items: center; 
    margin-top: 3%;
    padding: 3%;
    border: 1px solid #ddd; /* Add a border for better separation */
    border-radius: 8px; /* Add border-radius for a softer look */
}
.user-info {
    margin-right: 20px; /* Adjust the margin as needed */
}

.flex-container{
    display: flex;
}

.taskcontainer{
    background-color: #FFFFFF;
    margin-top: 3%;
    padding: 3%;
    width: 60%;
    margin-left: 6%;
    border: 1px solid #ddd; /* Add a border for better separation */
    border-radius: 8px; /* Add border-radius for a softer look */
}

.taskcontainer h3 {
    color: #333; /* Darken the text color for better readability */
    margin-bottom: 15px; /* Add some space below the heading */
}

.task-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px; /* Add space above the table */
}

.task-table th,
.task-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.task-table th {
    background-color: #f2f2f2; /* Add a light background color for header cells */
}

.no-tasks {
    color: #888; /* Dim the text color for a subtle look */
}

.dealscontainer {
    background-color: #FFFFFF;
    margin-top: 3%;
    padding: 2%;
    width: 60%;
    margin-left: 6%;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow for depth */
}

.dealscontainer h3 {
    color: #333;
    margin-bottom: 15px;
}

.deals-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 3px;
}

.deals-table th,
.deals-table td {
    border: 1px solid #ddd;
    padding: 12px; /* Increase padding for a bit more space */
    text-align: left;
}

.deals-table th {
    background-color: #f5f5f5; /* Lighter background color for header cells */
}

.no-deals {
    color: #888;
}

/* Add some space between the table rows for better readability */
.deals-table tbody tr {
    transition: background-color 0.3s ease;
}

.deals-table tbody tr:hover {
    background-color: #f9f9f9; /* Light background color on hover */
}

/* Add a fixed height and make the table scrollable */
.deals-table-container {
    max-height: 240px; /* Adjust the maximum height as needed */
    overflow-y: auto;
}


</style>

</head>
<body> 
@extends('layouts.sidebar')

@section('content')
    <section class="container-fluid">
        <div class="container flex-container">
            <div class="detailscontainer">
                <div class="user-info">
                    <h3><b>Welcome back, {{$user->name}} </b></h3>
                    <br>
                    <h5><b>{{$user->role}} </b></h5>
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-outline-primary">
                        <b> View profile</b>
                    </a>
                </div>
                <img src="{{ url('img/face.png') }}" alt="face">
            </div>
            <div class="taskcontainer">
                <h3>My Tasks</h3>
                @if(count($tasks) > 0)
                    <table class="task-table">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Due Date</th>
                                <!-- <th scope="col">Status</th> -->
                                <th scope="col">Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td> <a href="{{ route('tasks.show', $task->id) }}"> {{ $task->subject }} </a> </td>
                                    <td> {{ $task->due_date }} </td>
                                    <!-- <td> {{ $task->status }} </td> -->
                                    <td> {{ $task->priority }} </td>
                                </tr>
                            @endforeach   
                        </tbody>
                    </table>   
                @else
                    <p class="no-tasks"> No tasks assigned to you. </p>
                @endif
            </div>
        </div>
        <div class="container dealscontainer">
            <h3>My Pending Deals</h3>
            <div class="deals-table-container">
                @if(count($rfx) > 0)
                        <table class="deals-table">
                            <thead>
                                <tr>
                                    <th scope="col">Quote No</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Title </th>
                                    <th scope="col">Due date </th>
                                    <th scope="col">Quote Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rfx as $rfq)
                                    <tr>
                                        <td>RQ{{ $rfq->id }}</td>
                                        <td>{{ $rfq->Custom_Name }}</td>    
                                        <td>{{ $rfq->Custom_Email }}</td>
                                        <td>{{ $rfq->Company }}</td>
                                        <td>{{ $rfq->RFQ_title }}</td>
                                        <td>{{ $rfq->Due_date }}</td>
                                        <td> {{ $rfq->Quota_mount }}</td>
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>   
                    @else
                        <p class="no-deals"> No deals pending for you. </p>
                    @endif
            </div>
        </div>
    </section>

    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div> -->
@endsection
</body>

