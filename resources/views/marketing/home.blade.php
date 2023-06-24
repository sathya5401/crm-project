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
    margin-bottom: 5%;
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
                    <div style="background-color: white;">
                        <!-- <a href="{{ url('') }}" class="btn" style="color: black">
                            <img src="{{ url('img/search.png') }}" alt="search"> 
                            Search
                        </a> -->
                        <form action="{{ route('user.search') }}" method="GET" style="display: flex;">
                            <input type="text" name="search" placeholder="Search" class="form-control" style="margin-right: 5px;">
                            <button type="submit" class="btn btn-outline-primary" style="color: black">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>    

   </section>
@endsection


</body>
</html>
