@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Customer Registration') }}</div>

                <div class="card-body">
                    {{ __('Successfully created customer!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection