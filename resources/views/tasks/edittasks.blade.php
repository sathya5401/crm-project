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
                  <h4> Edit Task</h4>
               </div>
               <div>
                  <a href="{{ url('/tasks') }}" class="btn btn-light"> Back </a>
               </div>
               
            </div>
         </div>
         <div class="row card-row">
            <div class="col-12">
               <div class="card-body" style="padding: 2%;">
                  <form method="POST" action="{{ route('tasks.update', $task->id) }}">

                     @csrf
                     @method('PUT')

                    <div class="row">
                        <div class="col-4 flex-inputs">
                           <label for="owner">Owner</label>
                           <input type="text" name="owner" id="owner" value="{{ $task->owner }}" required autofocus />
                        </div>
                        <div class="col-4 flex-inputs">
                           <label for="contact">Customer/Lead</label>
                           <input type="text" name="contact" id="contact" value="{{ $task->contact }}" required />
                        </div>
                        <div class="col-4 flex-inputs">
                           <label for="due_date">Due Date </label>
                           <input type="date" name="due_date" id="due_date" min="{{ date('Y-m-d') }}" value="{{ $task->due_date }}"required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="subject">Subject</label>
                           <input type="text" name="subject" id="subject" value="{{ $task->subject }}" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="user_id">Assigned User</label>
                           <select name="user_id" id="user_id" class="form-control">
                                 @foreach($users as $user)
                                 <option value="{{ $user->id }}" {{ optional($task->assignedUser)->id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                 </option>
                                 @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 flex-inputs">
                           <label for="descrip">Description</label>
                           <input type="text" name="descrip" id="descrip" value="{{ $task->descrip }}" required />
                        </div>
                    </div>                     
                    <div class="col-12" style="margin-top:3%">
                        <button type="submit">Submit</button>
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














