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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <!-- Additional Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding-top: 3%;
            margin-top: 3%;
        }

        .card-body {
            padding: 2%;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .flex-inputs label {
            margin-bottom: 0.5rem;
        }

        .form-check {
            margin-bottom: 0.75rem;
        }

        .btn-primary {
            background-color: #000;
            color: #fff;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .overflow-scroll {
            max-height: 200px;
            overflow-y: auto;
        }

        .flex-row{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
    <section class="container-fluid bg-purple">
    <div class="container" style="margin-bottom: 2%;">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <div>
                    <h4>Create New Meeting</h4>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="https://meet.google.com/" target="_blank" class="btn btn-primary mr-2">Get meeting link</a>
                    <a href="{{ url('marketing/meeting') }}" class="btn btn-light">Back</a>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section class="container">
        <div class="row card-row">
            <div class="col-12">
                <div class="card card-body">
                    <form method="POST" action="{{ route('meeting.store') }}">
                        @csrf
                        <div class="row">
                           <div class="col-6 form-group">
                              <label for="title">Title:</label>
                              <input type="text" name="title" id="title" class="form-control" required autofocus />
                           </div>
                           <div class="col-6 form-group">
                              <label for="location">Location/Link:</label>
                              <input type="text" name="location" id="location" class="form-control" required />
                           </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="from">From:</label>
                                    <input type="datetime-local" name="from" id="from" class="form-control" />
                                </div>
                                <div class="col-6">
                                    <label for="to">To:</label>
                                    <input type="datetime-local" name="to" id="to" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="host_id">Host:</label>
                            <select name="host_id" id="host_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Participants:</label>
                            <div class="overflow-scroll">
                                @foreach ($users as $user)
                                    <div class="form-check">
                                        <input type="checkbox" name="participants[]" id="participant_{{ $user->id }}" value="{{ $user->id }}" class="form-check-input">
                                        <label for="participant_{{ $user->id }}" class="form-check-label">{{ $user->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Meeting</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection
</body>
</html>
