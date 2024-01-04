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
.flex-page {
    display: flex !important;
    justify-content: flex-end !important;
}
</style>



</head>
<body>
@extends('layouts.sidebar')
@section('content')
   <Section class="container-fluid ">
        @if ( (Auth::user()->is_admin) === 1)
            <div class="container container1">
                <div class="row">
                    <div>
                        My Inquiries
                    </div>
                    <div class="col-12 flex-buttons">
                        <div>
                            <a href="{{ url('inquiry/new') }}" class="btn btn-primary" style="color: black">Add Inquiry</a>
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
                        <tr >
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('inquiry.show', $inquiry->id) }}" > {{ $inquiry->message }} </a>
                            </td>
                            <td> {{ $inquiry->status }}</td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if ( (Auth::user()->is_admin) === 0)
            <div class="container container1">
                <div>
                        All inquiries
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Inquiry</th>
                            <th> Name</th>
                            <th> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($inquiries as $key => $inquiries)
                            <tr >
                                <td>{{ $key + 1 }}</td>
                                <td>
                                  <a href="{{ route('inquiry.show', $inquiries->id) }}" > {{ $inquiries->message }} </a>
                                </td>
                                <td>{{ $inquiries->name}}</td>
                                <td> {{ $inquiries->status}} </td>
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

