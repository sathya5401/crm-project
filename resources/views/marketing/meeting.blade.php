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
.bg-purple{
    background-color: #e0dcfc;
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
    margin-bottom: 3%;
    margin-top: 2%;
}
.flex-buttons{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

</style>



</head>
<body>
@extends('layouts.sidebar')
@section('content')
   <Section class="container-fluid ">
        <div class="container container1">
            <div class="row">
                <div class="col-12 flex-buttons">
                    <div>
                        <a href="{{ url('marketing/deals') }}" class="btn btn-primary" style="color: white">Deals</a>
                        <a href="{{ url('marketing/meeting') }}" class="btn btn-primary" style="color: white">Meeting</a>
                        <a href="{{ url('marketing/email') }}" class="btn btn-primary" style="color: white">Group Email</a>
                    </div>
                </div>
            </div>
        <div class="container" style="padding-top: 3%; margin-top: 0%">
            <div class="row" style="margin-bottom: 0%;">
                <div class="col-12 flex">
                    <div>
                        <h4>MEETING</h4>
                    </div>
                    <div style="margin-left: auto;">
                        <a href="{{ url('marketing/meeting/new') }}" class="btn btn-light">+ Create New Meeting</a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Location/Link</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Host</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($meeting as $key => $temp)
                    <tr >
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ $temp->title }}</td>
                        <td>{{ $temp->location }}</td>
                        <td>{{ $temp->from}}</td>
                        <td>{{ $temp->to}}</td>
                        <td>{{ optional($temp->host)->name }}</td>
                        <td class="icons">
                            <a href=""
                        onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this meeting?')) {
                                        document.getElementById('delete-form-{{ $temp->id }}').submit();
                                    }">
                            <img src="{{ url('img/delete.png') }}" alt="delete">
                        </a>
                        <form id="delete-form-{{ $temp->id }}" action="{{ route('meeting.destroy', $temp->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </section>
@endsection


</body>
</html>