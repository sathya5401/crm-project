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

.flex-buttons1 {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 2%;
}

.table thead tr {
    background-color: red !important;
    }

.flex-accordion {
    display: flex;
    align-items: baseline;
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
                    <a href="{{ url('RFx/new') }}" class="btn btn-primary" style="color: black">New RFx</a>
                </div>
                <div style="background-color: white;">
                    <form action="{{ route('rfx.search') }}" method="GET" style="display: flex;">
                        <input type="text" name="search" placeholder="Search RFx" class="form-control" style="margin-right: 5px;">
                        <button type="submit" class="btn btn-outline-primary" style="color: black">Search</button>
                        @if ($searchTerm)
                            <a href="{{ route('rfx.search') }}" class="btn btn-outline-primary" style="color: black; margin-left: 5px;">Reset</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Quote No</th>
                    <th scope="col">Company </th>
                    <th scope="col">Customer PIC</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Title</th>
                    <th scope="col">Due Date</th>
                    <th scope="col"> Final Pricing</th>
                    <th scope="col"> PIC</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Rfx as $key => $rfq)
                    <tr >
                        <td scope="row"><a href="{{ route('rfx.show', $rfq->id) }}">RQ{{ $rfq->id }} </a></td>
                        <td>{{ $rfq->Company }}</td>
                        <td>{{ $rfq->Custom_Name }}</td>    
                        <td>{{ $rfq->Custom_Email }}</td>
                        <td>{{ $rfq->RFQ_title }}</td>
                        <td>{{ $rfq->Due_date }}</td>
                        <td> {{ $rfq->Quota_mount }}</td>
                        <td> {{ optional($rfq->assignedUser)->name }}</td>
                        <td>
                        {{ $rfq->Status }}
                            <!-- <form method="post" action="{{ route('rfx.updateStatus', $rfq->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="flex-accordion">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="new" {{ $rfq->Status == 'new' ? 'selected' : '' }} >New</option>
                                            <option value="in-progress" {{ $rfq->Status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="submitted" {{ $rfq->Status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                            <option value="awarded" {{ $rfq->Status == 'approved' ? 'selected' : '' }}>Awarded</option>
                                            <option value="decline" {{ $rfq->Status == 'rejected' ? 'selected' : '' }}>Declined</option>
                                            Add more status options as needed
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:2%;margin-right:2%"> Set</button>
                                </div>
                            </form> -->
                        </td>
                        <td>
                            <a href="{{ route('rfx.edit', $rfq->id) }}">
                                <img src="{{ url('img/edit.png') }}" alt="Edit">
                            </a>
                            <a href="{{ route('rfx.delete', $rfq->id) }}"
                                onclick="event.preventDefault();
                                if (confirm('Are you sure you want to delete this user?')) {
                                    document.getElementById('delete-form-{{ $rfq->id }}').submit();
                                    }">
                                <img src="{{ url('img/delete.png') }}" alt="delete">
                            </a>
                            <form id="delete-form-{{ $rfq->id }}" action="{{ route('rfx.delete', $rfq->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>

   
<div class="pagination flex-page">
    @if ($perPage > 0)
        @for ($i = 1; $i <= ceil($totalRecords / $perPage); $i++)
            <a href="{{ route('rfx.index', ['page' => $i]) }}" class="{{ $currentPage == $i ? 'active' : '' }}">{{ $i }}</a>
        @endfor
    @endif
</div>
   


</section>
@endsection

</body>
</html>



















