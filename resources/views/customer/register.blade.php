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
                  <a href="{{ url('customer/listing') }}" class="btn btn-light"> Back </a>
               </div>
               
            </div>
         </div>
         <div class="row card-row">
            <div class="col-12">
               <div class="card-body" style="padding: 2%;">
                     @csrf
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="name">Name</label>
                           <input type="text" name="name" id="name" required autofocus />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="phoneNo">Phone Number</label>
                           <input type="phoneNo" name="phoneNo" id="phoneNo" required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="address">Address</label>
                           <input type="address" name="address" id="address" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="inv_address">Invoice Address</label>
                           <input type="inv_address" name="inv_address" id="inv_address" required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="pic">Person In Charge</label>
                           <input type="pic" name="pic" id="pic" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="email">Email</label>
                           <input type="email" name="email" id="email"/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="faxNo">Fax No.</label>
                           <input type="faxNo" name="faxNo" id="faxNo" required/>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="creditLimit">Credit Limit(RM)</label>
                           <input type="creditLimit" name="creditLimit" id="creditLimit" required/>
                        </div>
                     </div>
                     <div class="col-12" style="margin-top:3%">
                        <a href="{{ url('customer/confirm') }}" class="btn btn-dark">Create</a>
                     </div>
               </div>
            </div>
         </div>
      </div>

   </section>
@endsection


</body>
</html>