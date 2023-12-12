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
        .bg-purple {
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

        .container1 {
            margin-bottom: 5%;
            margin-top: 2%;
        }

        .flex-buttons {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .flex-page {
            display: flex !important;
            justify-content: flex-end !important;
        }

        /* Additional styles for improved layout */
        .form-check {
            margin-bottom: 1rem;
        }

        .row {
            margin-bottom: 1rem;
        }

        .btn-back {
            /* margin-top: 1rem; */
        }

        .btn-update {
            margin-top: 2rem;
            margin-bottom: 2%;
        }
        
        .container-sec {
            background-color: #F8F8F8	;
            margin-top: 3%;
        }
    </style>

</head>
<body>
@extends('layouts.sidebar')
@section('content')

    <section class="container-fluid">
        <form method="post" action="{{ route('user.updatePermission', ['id' => $user->id]) }}">
            @csrf
            <div class="container container-sec">
                <div class="row">
                    <div class="col-12" style="margin-top: 2%">
                        <h4> Update User Permission</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="{{ url('/user/listing') }}" class="btn btn-secondary btn-back"> Back </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="lead_create" id="lead_create" {{ $user->can_create_leads ? 'checked' : '' }}>
                            <label class="form-check-label" for="lead_create">
                                Create Lead
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="lead_delete" id="lead_delete" {{ $user->can_delete_leads ? 'checked' : '' }}>
                            <label class="form-check-label" for="lead_delete">
                                Delete Lead
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="lead_edit" id="lead_edit" {{ $user->can_edit_leads ? 'checked' : '' }}>
                            <label class="form-check-label" for="lead_edit">
                                Edit Lead
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rfx_create" id="rfx_create" {{ $user->can_create_rfx ? 'checked' : '' }}>
                            <label class="form-check-label" for="rfx_create">
                                Create RFx
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rfx_delete" id="rfx_delete" {{ $user->can_delete_rfx ? 'checked' : '' }}>
                            <label class="form-check-label" for="rfx_delete">
                                Delete RFx
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rfx_edit" id="rfx_edit" {{ $user->can_edit_rfx ? 'checked' : '' }}>
                            <label class="form-check-label" for="rfx_edit">
                                Edit RFx
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="connect_rfx" id="connect_rfx" {{ $user->can_connect_rfqs_data ? 'checked' : '' }}>
                            <label class="form-check-label" for="connect_rfx">
                                Connect RFx data with Looker Studio
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="connect_leads" id="connect_leads" {{ $user->can_connect_leads_data ? 'checked' : '' }}>
                            <label class="form-check-label" for="connect_leads">
                                Connect Leads data with Looker Studio
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="download_data" id="download_data" {{ $user->can_download_data ? 'checked' : '' }}>
                            <label class="form-check-label" for="download_data">
                                Download Raw Data
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-update">Update Permissions</button>
            </div>
        </form>

    </section>

@endsection


</body>
</html>
