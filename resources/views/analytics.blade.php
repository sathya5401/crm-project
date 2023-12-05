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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<!-- styles -->
<style>
.flex-container1 {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    margin-top: 10px;
}

.card {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    /* text-align: center; */
}

.card h2 {
    margin-bottom: 10px;
    font-size: 1.8rem;
    color: #333333;
}

.card h4 {
    margin: 0;
    font-size: 1.5rem;
    color: #007bff;
}

.percentage-increase {
    color: #28a745;
}

.revenue p {
    margin: 0;
    font-size: 0.9rem;
    /* color: #6c757d; */
}

.flex-percent {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.flex-buttons {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 2%;
    margin-top: 2%;
}

/* .connect-button {
    background-color: rgba(255,255,255,20%) !important;
} */

.last-container {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    /* background-color: rgba(255,255,255,90%); */
}

.performance-heading {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #334D6E;
}

.performance-info {
    /* margin-bottom: 3%; */
    /* margin-top: 3%; */
}

.performance-card {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 35px;
    width: 45%;
    /* text-align: center; */
}

.flex-cards{
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
}

.performance-font-td {
    font-size: 1.2rem;
}

.performance-font-tr {
    font-size: 1.1rem;
}
</style>

</head>
<body> 
@extends('layouts.sidebar')

@section('content')

    <section class="container-fluid">
            <div class="container">
                <div class=row>
                    <div class="col-12">
                        <div class="flex-buttons">
                            <div>
                                <a href="{{ route('integrate.rfx') }}" target="blank" class="btn btn-outline-primary connect-button" style="color: black;"><b>Connect rfqs data</b></a>
                                <a href="{{ route('integrate.leads') }}" target="blank" class="btn btn-outline-primary connect-button" style="color: black;"><b>Connect leads data</b></a>
                            </div>
                            <div>
                                <a href="{{ route('download') }}" class="btn btn-primary" style="color: black;"><b> Download Raw Data</b></a>
                            </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="flex-container1">
                            <div class="card deals">
                                <h2>Deals in Pipeline</h2>
                                <h4>{{ $pipelineRfx }}</h4>
                            </div>
                            <div class="card leads">
                                <h2>Leads This Month</h2>
                                <div class="flex-percent">
                                    <h4>{{ $currentMonthLeads }}</h4>
                                    <h5 class="percentage-increase"> ^ {{ number_format($percentageIncreaseLeads,2) }}%</h5>
                                </div>
                            </div>
                            <div class="card revenue">
                                <h2>Sales this Month</h2>
                                <div class="flex-percent">
                                    <h4> RM {{  number_format($totalRevenue,2) }}</h4>
                                    <p class="percentage-increase">^ {{ number_format($percentageIncreaseRevenue,2) }}%</p>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 last-container">
                        <div class="flex-cards">
                            <div class="performance-card">
                                <form method="GET" action="{{ route('analysis') }}" class="form-inline mb-2">
                                    @csrf
                                    <label for="months" class="mr-2">Select months:</label>
                                    <select name="months" id="months" class="form-control mr-2">
                                        <option value="1" {{ $selectedMonths == 1 ? 'selected' : '' }}>1 Month</option>
                                        <option value="2" {{ $selectedMonths == 2 ? 'selected' : '' }}>2 Months</option>
                                        <option value="3" {{ $selectedMonths == 3 ? 'selected' : '' }}>3 Months</option>
                                        <option value="4" {{ $selectedMonths == 4 ? 'selected' : '' }}>4 Months</option>
                                        <option value="5" {{ $selectedMonths == 5 ? 'selected' : '' }}>5 Months</option>
                                        <option value="6" {{ $selectedMonths == 6 ? 'selected' : '' }}>6 Months</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                    <button type="submit" class="btn btn-primary">Set</button>
                                </form>
                                <h4 class="performance-heading">Performance for the last {{ $selectedMonths }} months</h4>
                                <div class="performance-info">
                                    <canvas id="performanceChart"></canvas>
                                    <table class="table table-border table-sm" style="margin-top: 2%;">
                                        <tbody>
                                            <tr class="table-info">
                                                <td class="performance-font-tr">Total Sales for {{ $selectedMonths }} months </td>
                                                <td class="performance-font-td">RM{{$revenueWon}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="performance-card">
                                <canvas id="rfxAnalysisChart"></canvas>
                                <!-- <table class="table table-border table-sm" style="margin-top: 2%;">
                                    <tbody>
                                        <tr class="table-info">
                                            <td class="performance-font-tr">Created RFx</td>
                                            <td class="performance-font-td">{{$rfxCreated}}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <td class="performance-font-tr">Approved RFx</td>
                                            <td class="performance-font-td">{{$rfxApproved}}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <td class="performance-font-tr">Rejected RFx</td>
                                            <td class="performance-font-td">{{$rfxRejected}}</td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </section>
@endsection
</body>

<script>
document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('performanceChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Leads created', 'Deals created', 'Deals won'],
                datasets: [{
                    label: 'Count',
                    data: [{{$leadsCreated}}, {{$dealsCreated}}, {{$dealsWon}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
    

    document.addEventListener('DOMContentLoaded', function () {
        var rfxAnalysisCtx = document.getElementById('rfxAnalysisChart').getContext('2d');
        var rfxAnalysisChart = new Chart(rfxAnalysisCtx, {
            type: 'pie',
            data: {
                labels: ['Created deals', 'Approved deals', 'Rejected deals'],
                datasets: [{
                    data: [{{$rfxCreated}}, {{$rfxApproved}}, {{$rfxRejected}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
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
                        text: 'RFx Analysis (Last 3 Months)',
                        font: {
                            size: 16
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