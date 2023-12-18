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
.flex {
   display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
}

.bg-purple{
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

.flex-inputs{
   display: flex;
   flex-direction: column;

}

</style>
</head>
<body>
@extends('layouts.sidebar')
@section('content')
   <Section class="container-fluid bg-purple">

      <div class=container style="padding-top: 3%; margin-top: 3%">
         <div class="row" style="margin-bottom: 3%;">
            <div class="col-12 flex">
               <div>
                  <h4> Create New Customer</h4>
               </div>
               <div>
                  <a href="{{ url('customers/index') }}" class="btn btn-light"> Back </a>
               </div>
            </div>
         </div>
         <div class="row card-row">
            <div class="col-12">
               <div class="card-body" style="padding: 2%;">
        
    <!-- resources/views/customers/create.blade.php -->
<h5> Create New Customer</h5>
<form method="POST" action="{{ route('customers.store') }}">
    @csrf

    <div class="row">
        <div class="col-6 flex-inputs">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Name">
        </div>

        <div class="col-6 flex-inputs">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter Phone Number">   
        </div>
    </div>

    <div class="row">
        <div class="col-6 flex-inputs">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter Address">
        </div>

        <div class="col-6 flex-inputs">
            <label for="registration_no">Registration No:</label>
            <input type="text" id="registration_no" name="registration_no" placeholder="Enter registration number">
        </div>
    </div>

    <div class="row">
        <div class="col-6 flex-inputs">
            <label for="website_url">Website URL:</label>
            <input type="text" id="website_url" name="website_url" placeholder="Enter Website URL">
        </div>

    <div class="col-6 flex-inputs">
    <label for="fax_no">Fax Number:</label>
    <input type="text" id="fax_no" name="fax_no" placeholder="Enter Fax Number">
    </div>

    <!--person in charge -->

    <div class="row"></div>
    <h5>  </h5>
    <div class="space"></div>

    <div class="row">
    <h5> Person in charge</h5>
        <div class="col-3 flex-inputs">
            <label for="pic">Name:</label>
            <input type="text" id="pic" name="pic" placeholder="Enter person in charge's name">
        </div>

        <div class="col-3 flex-inputs">
            <label for="pic_phone">Phone:</label>
            <input type="text" id="pic_phone" name="pic_phone" placeholder="Enter person in charge's phone number" >
        </div>

        <div class="col-3 flex-inputs">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter person in charge's email">
        </div>

        <div class="col-3 flex-inputs">
            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation" placeholder="Enter person in charge's designation">
        </div>
    </div>

    <div class="col-12" style="margin-top:3%">
        <button type="submit" >Register</button>
        <div class="container">
    </div>

    </div>
</form>
</div>
            </div>
         </div>
      </div>
   </section>
@endsection
</body>
</html>