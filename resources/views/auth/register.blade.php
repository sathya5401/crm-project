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
    align-content: center;
    justify-content: center;
    align-items: center;
}

.bg-purple{
    background-color: #D8DCFC;
}

.crm-img{
    left: -4%;
    position: relative;
    width: 100%;
}

.login-text{
    display: flex;
    justify-content: center;
}
</style>



</head>
<body>
@extends('layouts.app')
@section('content')
    <Section class="container-fluid bg-purple">

        <div class="flex">
            <div class="container">
                <img src="{{ url('img/crm.jpg') }}"  alt="CRM image" class="crm-img"> 
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 login-text" style="margin-bottom: 13%;">
                        <h3 style="font-weight: bold;font-size: 45px"> Sign up </h3>
                    </div>
                    <!-- <div class="col-12 login-text">
                        <p> Sign in to continue </p>
                    </div> -->
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end" style="font-weight: bold;">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end" style="font-weight: bold;">{{ __('Email Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-form-label text-md-end" style="font-weight: bold;">{{ __('Company Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="company" class="form-control" name="company">
                                            </div>
                                        </div>



                                        <div class="row mb-3">
                                            <label for="phone_number" class="col-md-4 col-form-label text-md-end" style="font-weight: bold;">{{ __('Phone Number') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone_number"  class="form-control" name="phone_number" autofocus>

                                    
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end" style="font-weight: bold;">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end" style="font-weight: bold;">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                    </div>  
                   
   
        </div>

    </section>
    @endsection


</body>
</html>










