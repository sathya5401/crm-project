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
                  <h4> Edit RFx</h4>
               </div>
               <div>
                  <a href="{{ url('/RFx') }}" class="btn btn-light"> Back </a>
               </div>
               
            </div>
         </div>
         <div class="row card-row">
            <div class="col-12">
               <div class="card-body" style="padding: 2%;">
                  <form method="POST" action="{{ route('rfx.update', $Rfx->id) }}">

                     @csrf
                     @method('PUT')

                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="Company">Company</label>
                           <input type="text" name="Company" id="Company" value="{{ $Rfx->Company }}" required autofocus />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="user_id">PIC</label>
                           <select name="user_id" id="user_id" class="form-control">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ optional($Rfx->assignedUser)->id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="rfx_type">RFX type</label>
                           <select name="rfx_type" id="rfx_type" value="{{ $Rfx->rfx_type }}"  required>
                                 <option value="RFQ" @if($Rfx->rfx_type == 'RFQ') selected @endif> RFQ </option>
                                 <option value="SPA" @if($Rfx->rfx_type == 'SPA') selected @endif> SPA </option>
                                 <option value="Rental" @if($Rfx->rfx_type == 'Rental') selected @endif> Rental </option>
                                 <option value="Market Survey" @if($Rfx->rfx_type == 'Market Survey') selected @endif> Market Survey </option>
                                 <option value="ROI" @if($Rfx->rfx_type == 'ROI') selected @endif> ROI </option>
                           </select>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Custom_Name">Customer PIC</label>
                           <input type="text" name="Custom_Name" id="Custom_Name" value="{{ $Rfx->Custom_Name }}"  required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="Custom_Email">Customer Email</label>
                           <input type="email" name="Custom_Email" id="Custom_Email" value="{{ $Rfx->Custom_Email }}" required/>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Custom_Number">Customer Number</label>
                           <input type="number" name="Custom_Number" id="Custom_Number" value="{{ $Rfx->Custom_Number }}" required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="RFQ_title">RFQ Title</label>
                           <input type="text" name="RFQ_title" id="RFQ_title" value="{{ $Rfx->RFQ_title }}" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Due_date">Due Date </label>
                           <input type="date" name="Due_date" id="Due_date" min="{{ date('Y-m-d') }}" value="{{ $Rfx->Due_date }}" required/>
                        </div>      
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="Quota_mount">Final Pricing</label>
                           <input type="text" name="Quota_mount" id="Quota_mount" value="{{ $Rfx->Quota_mount }}" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="remarks">Remarks</label>
                           <input type="text" name="remarks" id="remarks" value="{{ $Rfx->remarks }}" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="decline">Decline Reason (if rejected) </label>
                           <input type="text" name="decline" id="decline" value="{{ $Rfx->decline }}" />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Status">Status</label>
                           <select name="Status" id="Status" value="{{$Rfx->Status}}" required>
                              <option value="new" @if($Rfx->Status == 'new') selected @endif>New</option>
                              <option value="in-progress" @if($Rfx->Status == 'in-progress') selected @endif>In-progress</option>
                              <option value="submitted" @if($Rfx->Status == 'submitted') selected @endif>Submitted</option>
                              <option value="awarded" @if($Rfx->Status == 'awarded') selected @endif>Awarded</option>
                              <option value="decline" @if($Rfx->Status == 'decline') selected @endif>Decline</option>
                           </select>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="award_amount">Award Amount </label>
                           <input type="text" name="award_amount" id="award_amount" value="{{ $Rfx->award_amount }}" />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="date_award">Date Award </label>
                           <input type="date" name="date_award" id="date_award" min="{{ date('Y-m-d') }}" value="{{ $Rfx->date_award }}" />
                        </div> 
                     </div>
                     <div class="row">
                        <div class="col-12" style="margin-top:3%">
                           <button type="submit">Submit</button>
                        </div>
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














