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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

<!-- styles -->
<style>
.flex {
   display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
}

.bg-purple{
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

.flex-inputs{
   display: flex;
   flex-direction: column;

}

</style>



</head>
<body>
@extends('layouts.sidebar')
@section('content')
   <Section class="container-fluid bg-purple">

      <div class=container style="padding-top: 3%; margin-top: 3%">
         <div class="row" style="margin-bottom: 3%;">
            <div class="col-12 flex">
               <div>
                  <h4> Create New User</h4>
               </div>
               <div>
                  <a href="{{ url('marketing/meeting') }}" class="btn btn-light"> Back </a>
               </div>
               
            </div>
         </div>
         <div class="row card-row">
            <div class="col-12">
               <div class="card-body" style="padding: 2%;">
                  <form method="POST" action="{{ route('meeting.store') }}">
                     @csrf
                     
                     <div class="row">
                        <div class="col-12 flex-inputs">
                           <label for="title">Title: </label>
                           <input type="text" name="title" id="title" required autofocus />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12 flex-inputs">
                           <label for="location">Location: </label>
                           <input type="text" name="location" id="location" required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="from">From: </label>
                           <input type="datetime-local" name="from" id="from"/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="to">To: </label>
                           <input type="datetime-local" name="to" id="to" required/>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                            <label for="host_id">Host: </label>
                            <select name="host_id" id="host_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="participants">Participants: </label>
                           <select name="participants[]" id="participants" multiple required>
                                 @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                 @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-12" style="margin-top:3%">
                        <button type="submit">Create Meeting</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      
   </section>
@endsection


</body>
</html>
<script>
    $(document).ready(function() {
        $('#participants').select2();
    });
</script>













