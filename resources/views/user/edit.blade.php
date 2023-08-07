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
    <div class="container">
        <h2>Edit User</h2>

        <form method="POST" action="{{ route('user.update', $user->id) }}">
            @csrf
            @method('PUT')

            <!-- Display existing user details in form fields -->
            <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="name">Name</label>
                           <input type="text" name="name" id="name" value="{{ $user->name }}" required autofocus />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="email">Email</label>
                           <input type="email" name="email" id="email" value="{{ $user->email }}" required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="phone_number">Phone Number</label>
                           <input type="phone_number" name="phone_number" value="{{ $user->phone_number }}" id="phone_number"/>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="role">Position</label>
                           <input type="role" name="role" id="role" value="{{ $user->role }}" required/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="branch">Branch</label>
                           <input type="branch" name="branch" id="branch" value="{{ $user->branch }}" required/>
                        </div>
                     </div>

                     <div class="col-12" style="margin-top:3%">
                        <button type="submit">Register</button>
                     </div>
        </form>
    </div>
@endsection

</body>
</html>