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
   margin-top: 1%;
}

.flex-inputs{
   display: flex;
   flex-direction: column;

}

/* .scroller {
   max-height: 720px;
   overflow-y: auto;
} */

</style>



</head>
<body>
@extends('layouts.sidebar')
@section('content')
   <Section class="container-fluid bg-purple ">

      <div class="container scroller" style="padding-top: 3%; margin-top: 1%">
         <div class="row" style="margin-bottom: 3%;">
            <div class="col-12 flex">
               <div>
                  <h4> Create New RFx</h4>
               </div>
               <div>
                  <a href="{{ url('/RFx') }}" class="btn btn-light"> Back </a>
               </div>
               
            </div>
         </div>
         <div class="row card-row" style="margin-bottom: 1%;">
            <div class="col-12">
               <div class="card-body" style="padding: 2%;">
                  <form method="POST" action="{{ route('rfx.store') }}" enctype="multipart/form-data">

                     @csrf
                     
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="Company">Company</label>
                           <!-- <input type="text" name="Company" id="Company" required autofocus /> -->
                           <select name="Company" id="Company" required>
                              @foreach ($customers as $customer)
                                 <option value="{{ $customer->Company }}">{{ $customer->Company }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="user_id">PIC</label>
                           <select name="user_id" id="user_id" required>
                              @foreach ($users as $user)
                                 <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="rfx_type">RFX type</label>
                           <select name="rfx_type" id="rfx_type" required>
                                 <option value="RFQ"> RFQ </option>
                                 <option value="SPA"> SPA </option>
                                 <option value="Rental"> Rental </option>
                                 <option value="Market Survey"> Market Survey </option>
                                 <option value="ROI"> ROI </option>
                           </select>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Custom_Name">Customer PIC</label>
                           <!-- <input type="text" name="Custom_Name" id="Custom_Name" required /> -->
                           <select name="Custom_Name" id="Custom_Name" required>
                              @foreach ($customers as $customer)
                                 <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="Custom_Email">Customer Email</label>
                           <input type="email" name="Custom_Email" id="Custom_Email" required/>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Custom_Number">Customer Number</label>
                           <input type="number" name="Custom_Number" id="Custom_Number" required />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="RFQ_title">RFQ Title</label>
                           <input type="text" name="RFQ_title" id="RFQ_title" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Due_date">Due Date </label>
                           <input type="date" name="Due_date" id="Due_date" min="{{ date('Y-m-d') }}" required/>
                        </div>      
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="Quota_mount">Final Pricing</label>
                           <input type="text" name="Quota_mount" id="Quota_mount" required />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="remarks">Remarks</label>
                           <input type="text" name="remarks" id="remarks" />
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="decline">Decline Reason (if rejected) </label>
                           <input type="text" name="decline" id="decline"  />
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="Status">Status</label>
                           <select name="Status" id="Status" required>
                                 <option value="new"> New </option>
                                 <option value="in-progress"> In-progress </option>
                                 <option value="submitted"> Submitted </option>
                                 <option value="awarded"> Awarded </option>
                                 <option value="decline"> Decline </option>
                           </select>
                        </div>
                     </div>
                     <hr>
                     <div class="row">
                        <div class="col-6 flex-inputs">
                           <label for="award_amount">Award Amount </label>
                           <input type="text" name="award_amount" id="award_amount"/>
                        </div>
                        <div class="col-6 flex-inputs">
                           <label for="date_award">Date Award </label>
                           <input type="date" name="date_award" id="date_award" min="{{ date('Y-m-d') }}"/>
                        </div> 
                     </div>
                     <hr>
                     <div class="row" id="documentInputsContainer">
                        <div class="col-4 flex-inputs">
                           <label for="document_name">Document Name</label>
                           <input type="text" name="document_name[]" required />
                        </div>
                        <div class="col-4 flex-inputs">
                           <label for="document_type">Document Type</label>
                           <select name="document_type[]" id="document_type" required>
                                 <option value="Contract">Contract</option>
                                 <option value="Costing Sheet">Costing Sheet</option>
                                 <option value="Final Quotation">Final Quotation</option>
                                 <option value="Submission Document">Submission Document</option>
                                 <option value="Supporting Document">Supporting Document</option>
                                 <option value="Tender Document">Tender Document</option>
                                 <option value="Invoice">Invoice</option>
                                 <option value="Costing Summary">Costing Summary</option>
                                 <option value="Credit Note">Credit Note</option>
                              </select>
                        </div>
                        <div class="col-4 flex-inputs">
                           <label for="file">File</label>
                           <input type="file" name="file[]" multiple />
                        </div>
                     </div>
                     <button style="margin-top: 1%" type="button" id="addDocumentInput">Add Document</button>   
                     <div class="col-12" style="margin-top:3%">
                        <button type="submit">Register</button>
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
document.addEventListener('DOMContentLoaded', function () {
    const addDocumentInputButton = document.getElementById('addDocumentInput');
    const documentInputsContainer = document.getElementById('documentInputsContainer');

    addDocumentInputButton.addEventListener('click', function () {
        const newDocumentInputsGroup = document.createElement('div');
        newDocumentInputsGroup.className = 'row';

        const documentNameInput = document.createElement('div');
        documentNameInput.className = 'col-4 flex-inputs';
        documentNameInput.innerHTML = '<label for="document_name">Document Name</label><input type="text" name="document_name[]" required />';

        const documentTypeInput = document.createElement('div');
        documentTypeInput.className = 'col-4 flex-inputs';
        documentTypeInput.innerHTML = '<label for="document_type">Document Type</label><select name="document_type[]" required><option value="Contract">Contract</option><option value="Costing Sheet">Costing Sheet</option><option value="Final Quotation">Final Quotation</option><option value="Submission Document">Submission Document</option><option value="Supporting Document">Supporting Document</option><option value="Tender Document">Tender Document</option><option value="Invoice">Invoice</option><option value="Costing Summary">Costing Summary</option><option value="Credit Note">Credit Note</option> </select>';

        const fileInput = document.createElement('div');
        fileInput.className = 'col-4 flex-inputs';
        fileInput.innerHTML = '<label for="file">File</label><input type="file" name="file[]" multiple />';

        newDocumentInputsGroup.appendChild(documentNameInput);
        newDocumentInputsGroup.appendChild(documentTypeInput);
        newDocumentInputsGroup.appendChild(fileInput);

        documentInputsContainer.appendChild(newDocumentInputsGroup);
    });
});
</script>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addFileInputButton = document.getElementById('addFileInput');
        const fileInputsContainer = document.getElementById('fileInputsContainer');

        addFileInputButton.addEventListener('click', function () {
            const newFileInputsGroup = document.createElement('div');
            newFileInputsGroup.className = 'row';
            
            const documentNameInput = document.createElement('div');
            documentNameInput.className = 'col-4 flex-inputs';
            documentNameInput.innerHTML = '<label for="document_name">Document Name</label><input type="text" name="document_name[]" required />';
            
            const documentTypeInput = document.createElement('div');
            documentTypeInput.className = 'col-4 flex-inputs';
            documentTypeInput.innerHTML = '<label for="document_type">Document Type</label><select name="document_type[]" required><option value="contract">Contract</option><option value="costing_sheet">Costing Sheet</option><option value="final_quotation">Final Quotation</option><option value="sub_document">Submission Document</option><option value="sup_documet">Supporting Document</option><option value="tender_documet">Tender Document</option><option value="invoice">Invoice</option><option value="costing_summary">Costing Summary</option><option value="credit_note">Credit Note</option> </select>';
            
            const fileInput = document.createElement('div');
            fileInput.className = 'col-4 flex-inputs';
            fileInput.innerHTML = '<label for="file">File</label><input type="file" name="file[]" multiple required />';
            
            newFileInputsGroup.appendChild(documentNameInput);
            newFileInputsGroup.appendChild(documentTypeInput);
            newFileInputsGroup.appendChild(fileInput);
            
            fileInputsContainer.appendChild(newFileInputsGroup);
        });
    });
</script> -->












