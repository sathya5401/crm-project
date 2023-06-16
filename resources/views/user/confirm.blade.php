@extends('layouts.sidebar')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Registeration') }}</div>

                <div class="card-body">
                    {{ __('The user has been created!') }}
                    <p> Pls double check in database </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection