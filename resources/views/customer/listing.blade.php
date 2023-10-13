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
                        <a href="{{ url('customer/register') }}" class="btn btn-primary" style="color: black">New Customer</a>
                    </div>
                    <div style="background-color: white;">
                        <!-- <a href="{{ url('') }}" class="btn" style="color: black">
                            <img src="{{ url('img/search.png') }}" alt="search"> 
                            Search
                        </a> -->
                        <form  method="GET" style="display: flex;">
                            <input type="text" name="search" placeholder="Search customers" class="form-control" style="margin-right: 5px;">
                            <button type="submit" class="btn btn-outline-primary" style="color: black">Search</button>
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
                    <th scope="col">Address</th>
                    <th scope="col">Person in Charge</th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col">1</td>
                    <td scope="col">Stabilo Sdn Bhd</td>
                    <td scope="col">stabilo@gmail.com</td>
                    <td scope="col">6, Jalan SR 8/3, Taman Serdang Raya, 43300 Seri Kembangan, Selangor</td>
                    <td scope="col">Farhan</td>
                    <td class="icons">  
                            <img src="{{ url('img/role.png') }}" alt="role"> 
                            <img src="{{ url('img/edit.png') }}" alt="role"> 
                            <img src="{{ url('img/delete.png') }}" alt="delete">
                        </td>
                </tr>
                <tr>
                    <td scope="col">2</td>
                    <td scope="col">Zaba' enterprise sdn bhd</td>
                    <td scope="col">zaba@gmail.com</td>
                    <td scope="col">101, Persiaran Damai, Taman Sentosa, 32610, Perak</td>
                    <td scope="col">Azfar Harim</td>
                    <td class="icons">  
                            <img src="{{ url('img/role.png') }}" alt="role"> 
                            <img src="{{ url('img/edit.png') }}" alt="role"> 
                            <img src="{{ url('img/delete.png') }}" alt="delete">
                        </td>
                </tr>
            </tbody>   
        </table>

   </section>
@endsection


</body>
</html>
