<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
        .text-center {
            text-align: center;
        }
    </style>
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

.text-center {
    text-align: center;
}

</style>



</head>
<body>
@extends('layouts.sidebar')
@section('content')
   <Section class="container-fluid ">
   <div class="container container1">
        <div class="row">
            <!-- First Column for Create Button -->
            <div class="col-md-6">
                <a href="{{ url('customers/create') }}" class="btn btn-primary" >Create New Customer</a>
            </div>

            <!-- Second Column for Data Button, with right alignment -->
            <div class="col-md-6 text-md-right">
                <a href="{{ route('customers.data') }}" class="btn btn-primary">View Customer Data</a>
            </div>
        </div>
    </div>

        <div class="row">
            <form action="{{ route('customers.index') }}" method="GET" class="form-inline justify-content-end">
                <div class="form-group mb-2">
                    <label for="filter-category" class="sr-only"></label>
                    <select name="category" id="filter-category" class="form-control">
                        <option value="">All Categories</option>
                        <option value="Upstream">Upstream</option>
                        <option value="Midstream">Midstream</option>
                        <option value="Downstream">Downstream</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-2">Filter</button>
            </form>
        </div>

        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" scope="col">No</th>
                    <th class="text-center" scope="col">Name</th>
                    <th class="text-center" scope="col">Email</th>
                    <th class="text-center" scope="col">Address</th>
                    <th class="text-center" scope="col">Category</th>
                    <th class="text-center" scope="col">Person in Charge</th>
                    <th class="text-center" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @php $rowNumber = 1; @endphp <!-- Initialize a counter -->
            @foreach ($customers as $customer)
                    <tr >
                    <td class="text-center">{{ $rowNumber++ }}</td>
                    <td class="text-center">{{ $customer->name }}</td>
                    <td class="text-center">{{ $customer->email }}</td>
                    <td class="text-center">{{ $customer->address }}</td>
                    <td class="text-center">{{ $customer->category}}</td>
                    <td class="text-center">{{ $customer->pic}}</td>
                    <td class="text-center icons">  
                            <a href="{{ route('customers.edit', $customer->id) }}">
                                <img src="{{ url('img/edit.png') }}" alt="Edit">
                            </a> 
                            <a href="{{ route('customers.destroy', $customer->id) }}"
                        onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this customer?')) {
                                        document.getElementById('delete-form-{{ $customer->id }}').submit();
                                    }">
                            <img src="{{ url('img/delete.png') }}" alt="delete">
                        </a>
                        <form id="delete-form-{{ $customer->id }}" action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: none;">
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
