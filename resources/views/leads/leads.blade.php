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
.flex-buttons {
    display: flex;
}

.btn-shape {
    border-radius: 0 !important;
}

.btn.active {
    background-color: #b3d1ff !important;  /* Change this to the color you want for the active button */
    color: black !important;
}

.table thead tr {
            background-color: red !important;
        }
.icons {
    display: flex;
    align-items: stretch;
    justify-content: center;
}
/* .btn {
  background-color: #000;
  color: #fff;
  font-size: 16px;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
} */
.container1{
    margin-bottom: 5%;
    margin-top: 2%;
}

.flex-buttons1 {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 2%;
}

.flex-page {
    display: flex !important;
    justify-content: flex-end !important;
}

.subject-font{
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

</style>
</head>

<body>
@extends('layouts.sidebar')

@section('content')

<section class="container">
    
    <div class="container" style="padding-top: 2%">
        <div class="row">
            <div class="col-12 flex-buttons">
                <div>
                    <a href="{{ url('leads') }}" class="btn btn-outline-secondary btn-shape {{ request()->is('leads*') ? 'active' : '' }}">Leads</a>
                </div>
                <div>
                    <a href="{{ url('RFx') }}" class="btn btn-outline-secondary btn-shape {{ request()->is('RFx*') ? 'active' : '' }}">RFx</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 3%"> 
            <div class="col-12 flex-buttons1">
                <div>
                    <a href="{{ url('leads/new') }}" class="btn btn-primary" style="color: black">New Lead</a>
                </div>
                <div style="background-color: white;">
                    <form action="{{ route('leads.search') }}" method="GET" style="display: flex;">
                        <input type="text" name="search" placeholder="Search users" class="form-control" style="margin-right: 5px;">
                        <button type="submit" class="btn btn-outline-primary" style="color: black">Search</button>
                        @if ($searchTerm)
                            <a href="{{ route('leads.search') }}" class="btn btn-outline-primary" style="color: black; margin-left: 5px;">Reset</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
  

    <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Fax No</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Company</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $key => $lead)
                    <tr >
                        <td scope="row">{{ $key+1 }}</td>
                        <td><a class="subject-font" href="{{ route('leads.show', $lead->id) }}"> {{ $lead->name }} </a> </td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->title}}</td>
                        <td>{{ $lead->faxNo}}</td>
                        <td>{{ $lead->phone_number}}</td>
                        <td> {{ $lead->company}}</td>
                        <td>
                            <a href="{{ route('leads.edit', $lead->id) }}">
                                <img src="{{ url('img/edit.png') }}" alt="Edit">
                            </a>
                            <a href="{{ route('leads.delete', $lead->id) }}"
                            onclick="event.preventDefault();
                                        if (confirm('Are you sure you want to delete this lead?')) {
                                            document.getElementById('delete-form-{{ $lead->id }}').submit();
                                        }">
                                <img src="{{ url('img/delete.png') }}" alt="delete">
                            </a>
                            <form id="delete-form-{{ $lead->id }}" action="{{ route('leads.delete', $lead->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

           
        <div class="pagination flex-page">
            @for ($i = 1; $i <= ceil($totalRecords / $perPage); $i++) 
               <a href="{{ route('leads', ['page' => $i, 'search' => $searchTerm]) }}" class="{{ $currentPage == $i ? 'active' : '' }}">{{ $i }}</a> 
            @endfor 
        </div>
   

</section>
@endsection

</body>
</html>



















