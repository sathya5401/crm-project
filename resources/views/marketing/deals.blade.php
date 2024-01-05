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
.dealscontainer {
    background-color: #FFFFFF;
    margin-top: 1%;
    padding: 2%;
    width: 60%;
    margin-left: 6%;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow for depth */
}

.dealscontainer h3 {
    color: #333;
    margin-bottom: 15px;
}

.deals-table {
    width: 100%;
    border-collapse: collapse;
    /* margin-top: 3px; */
}

.deals-table th,
.deals-table td {
    border: 1px solid #ddd;
    padding: 12px; /* Increase padding for a bit more space */
    text-align: left;
}

.deals-table th {
    background-color: #f5f5f5; /* Lighter background color for header cells */
}

.no-deals {
    color: #888;
}

/* Add some space between the table rows for better readability */
.deals-table tbody tr {
    transition: background-color 0.3s ease;
}

.deals-table tbody tr:hover {
    background-color: #f9f9f9; /* Light background color on hover */
}

/* Add a fixed height and make the table scrollable */
.deals-table-container {
    max-height: 360px; /* Adjust the maximum height as needed */
    overflow-y: auto;
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
                </div>
            </div>
        </div>    
    </section>
        <div>
             <h4> ONGOING DEALS</h4>
        </div>
    <section>
    <div class="container dealscontainer">
            <div class="deals-table-container">
                @if(count($deals) > 0)
                        <table class="deals-table">
                            <thead>
                                <tr>
                                    <th scope="col">Quote No</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Customer Email</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Title </th>
                                    <th scope="col">Due date </th>
                                    <th scope="col">Quote Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deals as $rfq)
                                    <tr>
                                        <td><a class="subject-font" href="{{ route('rfx.show', $rfq->id) }}">RQ{{ $rfq->id }} </a></td>
                                        <td>{{ $rfq->Custom_Name }}</td>    
                                        <td>{{ $rfq->Custom_Email }}</td>
                                        <td>{{ $rfq->Company }}</td>
                                        <td>{{ $rfq->RFQ_title }}</td>
                                        <td>{{ $rfq->Due_date }}</td>
                                        <td> {{ $rfq->Quota_mount }}</td>
                                    </tr>
                                @endforeach   
                            </tbody>
                        </table>   
                    @else
                        <p class="no-deals"> No deals pending for you. </p>
                    @endif
            </div>
        </div> 
   </section>
@endsection


</body>
</html>