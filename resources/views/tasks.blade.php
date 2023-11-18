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
/* .icons {
    display: flex;
    align-items: stretch;
    justify-content: center;
} */
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
   <Section class="container-fluid ">
        <div class="container container1">
            <div class="row">
                <div class="col-12 flex-buttons">
                    <div>
                        <a href="{{ url('tasks/new') }}" class="btn btn-primary" style="color: black">New Task</a>
                    </div>
                    <!-- <div style="background-color: white;">
                        <form action="{{ route('user.search') }}" method="GET" style="display: flex;">
                            <input type="text" name="search" placeholder="Search users" class="form-control" style="margin-right: 5px;">
                            <button type="submit" class="btn btn-outline-primary" style="color: black">Search</button>
                          {{-- @if ($searchTerm) --}}
                                <a href="{{ route('user.search') }}" class="btn btn-outline-primary" style="color: black; margin-left: 5px;">Reset</a>
                        {{--  @endif --}}
                        </form>
                    </div> -->
                </div>
            </div>
        </div>    
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Priority</th>
                    <th scope="col"> Assigned </th>
                    <th scope="col"> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($task as $key => $temp)
                    <tr >
                        <td scope="row">{{ $key + 1 }}</td>
                        <td> <a href="{{ route('tasks.show', $temp->id) }}"> {{ $temp->subject }} </a> </td>
                        <td>{{ $temp->owner }}</td>
                        <td>{{ $temp->due_date}}</td>
                        <form method="post" action="{{ route('tasks.updateStatus', $temp->id) }}">
                            @csrf
                            @method('PATCH')
                            <td>
                                <div class="flex-accordion">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="open" {{ $temp->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="close" {{ $temp->status == 'close' ? 'selected' : '' }}>Close</option>
                                            <!-- Add more status options as needed -->
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:2%;"></button>
                                </div>
                            </td>
                        </form>
                        <!-- Update priority form -->
                        <form method="post" action="{{ route('tasks.updatePriority', $temp->id) }}">
                            @csrf
                            @method('PATCH')
                            <td>
                                <div class="flex-accordion">
                                    <div class="form-group">
                                        <select name="priority" class="form-control">
                                            <option value="low" {{ $temp->priority == 'low' ? 'selected' : '' }}>Low</option>
                                            <option value="medium" {{ $temp->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="high" {{ $temp->priority == 'high' ? 'selected' : '' }}>High</option>
                                            <!-- Add more priority options as needed -->
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm" style="margin-left:2%;"></button>
                                </div>
                            </td>
                        </form>
                        <td>{{ optional($temp->assignedUser)->name }} </td>
                        <td class="icons"> 
                            <a href="{{ route('tasks.edit', $temp->id) }}">
                                <img src="{{ url('img/edit.png') }}" alt="Edit">
                            </a> 
                            <a href="{{ route('tasks.delete', $temp->id) }}"
                                onclick="event.preventDefault();
                                    if (confirm('Are you sure you want to delete this user?')) {
                                        document.getElementById('delete-form-{{ $temp->id }}').submit();
                                    }">
                                <img src="{{ url('img/delete.png') }}" alt="delete">
                            </a>
                            <form id="delete-form-{{ $temp->id }}" action="{{ route('tasks.delete', $temp->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="pagination flex-page">
        @for ($i = 1; $i <= ceil($totalRecords / $perPage); $i++)
            <a href="{{ route('tasks.index', ['page' => $i]) }}" class="{{ $currentPage == $i ? 'active' : '' }}">{{ $i }}</a>
        @endfor
     </div>
   </section>
@endsection


</body>
</html>

















