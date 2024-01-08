<!DOCTYPE html>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- styles -->
    <style>
    body {
        font-family: 'Nunito', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333; /* Text color */
    }

    .container-fluid {
        padding: 20px;
        text-align: center; /* Center the content */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        background: #fff; /* White background */
        margin: 20px auto; /* Centering the container */
        max-width: 95%; /* Maximum width */
    }

    canvas {
        max-width: 100%; /* Make the chart responsive */
        height: 80vh !important; /* Maintain aspect ratio */
        /* Additional styles for the canvas can be added here */
    }

    /* Additional custom styles */
</style>

</head>
<body>
@extends('layouts.sidebar')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3 align-items-center"> <!-- Align items center for vertical alignment -->
            <div class="col-6 text-center"> <!-- Column for Customer Data Heading, centered text -->
                <h2>Customer</h2>
            </div>
            <div class="col-6 text-right"> <!-- Column for Back button, aligned to the right -->
                <a href="{{ url('/customers') }}" class="btn btn-secondary" style="background-color: purple; border-color: purple;">Back</a>
            </div>
        </div>

        <canvas class="canvas" id="customerChart"></canvas>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('customerChart').getContext('2d');
        var customerChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Upstream', 'Midstream', 'Downstream', 'Total'],
                datasets: [{
                    label: 'Customer Count',
                    data: [
                        {{ $upstream }}, 
                        {{ $midstream }}, 
                        {{ $downstream }}, 
                        {{ $total }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

</body>
</html>
