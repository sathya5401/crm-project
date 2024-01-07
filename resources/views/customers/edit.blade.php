<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        .flex {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-between;
        }

        .bg-purple {
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

        .flex-inputs {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .row:not(.person-in-charge) .col-6 {
            flex: 0 0 48%;
            margin-right: 2%;
        }

        .row.person-in-charge .col-3 {
            flex: 0 0 48%;
            margin-right: 2%;
        }

        .row.person-in-charge .col-3:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
        <section class="container-fluid bg-purple">
            <div class="container" style="padding-top: 3%; margin-top: 3%">
                <div class="row" style="margin-bottom: 3%;">
                    <div class="col-12 flex">
                        <div>
                            <h4>Edit Customer</h4>
                        </div>
                        <div>
                            <a href="{{ url('/customers') }}" class="btn btn-light">Back</a>
                        </div>
                    </div>
                </div>
                <div class="row card-row">
                    <div class="col-12">
                        <div class="card-body" style="padding: 2%;">

                            <!-- resources/views/customers/create.blade.php -->
                            <form method="POST" action="{{ route('customers.update', $customer->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6 flex-inputs">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" name="name" value="{{ $customer->name }}" >
                                    </div>
                                
                                    <div class="col-6 flex-inputs">
                                        <label for="Company">Company:</label>
                                        <input type="text" id="Company" name="Company" value="{{ $customer->Company }}">   
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 flex-inputs">
                                        <label for="phone">Phone:</label>
                                        <input type="text" id="phone" name="phone" value="{{ $customer->phone }}">   
                                    </div>

                                    <div class="col-6 flex-inputs">
                                        <label for="email">Email:</label>
                                        <input type="text" id="email" name="email" value="{{ $customer->email }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6 flex-inputs">
                                        <label for="address">Address:</label>
                                        <input type="text" id="address" name="address" value="{{ $customer->address }}" >
                                    </div>

                                    <div class="col-6 flex-inputs">
                                        <label for="registration_no">Registration No:</label>
                                        <input type="text" id="registration_no" name="registration_no"  value="{{ $customer->registration_no }}">
                                    </div>
                                </div>    

                                <div class="row">
                                    <div class="col-6 flex-inputs">
                                        <label for="website_url">Website URL:</label>
                                        <input type="text" id="website_url" name="website_url" value="{{ $customer->website_url }}">
                                    </div>

                                    <div class="col-6 flex-inputs">
                                        <label for="fax_no">Fax Number:</label>
                                        <input type="text" id="fax_no" name="fax_no" value="{{ $customer->fax_no }}">
                                    </div>
                               

                                <!-- Customer Category-->
                                <h5>Customer Category</h5>
                                <div class="row">
                                    <div class="col-12 flex-inputs">
                                        <select name="category" id="category" class="form-control" required>
                                            <option value="" disabled selected>Please Select Customer Category</option>
                                            <option value="Upstream" {{ $customer->category == 'Upstream' ? 'selected' : '' }}>Upstream</option>
                                            <option value="Midstream" {{ $customer->category == 'Midstream' ? 'selected' : '' }}>Midstream</option>
                                            <option value="Downstream" {{ $customer->category == 'Downstream' ? 'selected' : '' }}>Downstream</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Person in charge -->
                                <h5>Person in Charge</h5>
                                    <div class="row person-in-charge">
                                        <div class="col-md-4 flex-inputs">
                                            <label for="pic">Name:</label>
                                            <input type="text" id="pic" name="pic" value="{{ $customer->pic }}">
                                        </div>

                                        <div class="col-md-4 flex-inputs">
                                            <label for="pic_phone">Phone:</label>
                                            <input type="text" id="pic_phone" name="pic_phone" value="{{ $customer->pic_phone }}">
                                        </div>

                                        <div class="col-md-4 flex-inputs">
                                            <label for="designation">Designation:</label>
                                            <input type="text" id="designation" name="designation" value="{{ $customer->designation }}">
                                        </div>
                                    </div>

                                <!-- Customer References
                                <h5>Customer References</h5>
                                <div class="row customer reference">
                                    <div class="col-12 flex-inputs">
                                        <label for="reference">Document</label>
                                        <input type="reference" name="reference[]" multiple />
                                    </div>
                                </div>-->
                                <div class="col-12" style="margin-top: 3%">
                                    <button type="submit" id="updateButton">Update Customer</button>
                                </div>
                                <script>
                                    document.getElementById('updateButton').addEventListener('click', function() {
                                        alert('Successfully update!');
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</body>
</html>
