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
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
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
        .flex-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* margin-bottom: 1.5rem; */
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .table {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            text-align: center;
        }
        .table a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .table a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
    <section class="container-fluid">
        @if (Auth::user()->is_admin)
        <div class="container container1">
            <div class="row">
                <div>
                   <h3> My Inquiry </h3> 
                </div>
                <div class="col-12 flex-buttons">
                    <div style="margin-top: 2%;">
                        <a href="{{ url('inquiry/new') }}" class="btn btn-primary">Add New Inquiry</a>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Inquiry</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiry as $key => $inquiry)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <a href="{{ route('inquiry.show', $inquiry->id) }}">{{ $inquiry->message }}</a>
                    </td>
                    <td>{{ $inquiry->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @if (!Auth::user()->is_admin)
        <div class="container container1">
            <div style="margin-bottom: 3%;" class="flex-buttons">
                <div>
                   <h3>Inquiry List </h3> 
                </div>
                <div>
                    <a href="{{ route('inquiry.data') }}" class="btn btn-primary">View Inquiries Data</a>
                </div>
            </div>

           <div class="row">
                <div class="col-md-6 d-flex justify-content-between">
                    <form action="{{ route('inquiry.index') }}" method="GET" class="form-inline">
                        <div class="form-group mb-2">
                            <label for="filter-status" class="sr-only"></label>
                            <select name="status" id="filter-status" class="form-control">
                                <option value="">All Status</option>
                                <option value="new">New</option>
                                <option value="in-progress">In-progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 ml-2">Filter</button>
                    </form>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Inquiry</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inquiries as $key => $inquiries)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <a href="{{ route('inquiry.show', $inquiries->id) }}">{{ $inquiries->message }}</a>
                        </td>
                        <td>{{ $inquiries->name }}</td>
                        <td>{{ $inquiries->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </section>
    @endsection
</body>
</html>
