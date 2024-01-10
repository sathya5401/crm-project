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
        }

        .container-fluid {
            padding: 20px;
            text-align: center; /* Center the content */
        }

        canvas {
            max-width: 100%; /* Make the chart responsive */
            height: 80vh !important; /* Maintain aspect ratio */
        }

        /* Add your own styles as needed */
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
        <div class="container-fluid">
            <div class="row mb-3 align-items-center"> <!-- Align items center for vertical alignment -->
                <div class="col-6 text-center"> <!-- Column for Customer Data Heading, centered text -->
                    <h2>Inquiry Analysis</h2>
                </div>
                <div class="col-6 text-right"> <!-- Column for Back button, aligned to the right -->
                    <a href="{{ url('/inquiry') }}" class="btn btn-secondary" style="background-color: purple; border-color: purple;">Back</a>
                </div>
            </div>

            <canvas class="canvas" id="inquiryAnalysisChart"></canvas>
        </div>
    @endsection

    <!-- Add your scripts at the end of the body tag -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var inquiryAnalysisCtx = document.getElementById('inquiryAnalysisChart').getContext('2d');
            var inquiryAnalysisChart = new Chart(inquiryAnalysisCtx, {
                type: 'pie',
                data: {
                    labels: ['New inquiries', 'Complete inquiries', 'In-progress inquiries'],
                    datasets: [{
                        data: [{{$inquiries}}, {{$solved}}, {{$pending}}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Inquiries Data',
                            font: {
                                size: 10
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
