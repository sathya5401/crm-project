<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Head content goes here -->
    <!-- Add your CSS styles here -->
    <style>
        .container {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #6c757d;
        }
        th {
            width: 150px;
            text-align: right;
            color: #495057;
        }
        td {
            color: #343a40;
        } 
        .btn-back {
            /* margin-top: 10px; */
        }
        /* .scroller {
            max-height: 720px;
            overflow-y: auto;
        } */
        .file-list {
            list-style: none;
            padding: 0;
        }
        .file-item {
            margin-bottom: 8px;
        }
        .file-link {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
    @extends('layouts.sidebar')
    @section('content')
        <div class="container scroller">
            <h2>RFx Details</h2>
            <table class="table">
                <tr>
                    <th>RFX type:</th>
                    <td>{{ $Rfx->rfx_type }}</td>
                </tr>
                <tr>
                    <th>Company:</th>
                    <td>{{ $Rfx->Company }}</td>
                </tr>
                <tr>
                    <th>Customer PIC :</th>
                    <td>{{ $Rfx->Custom_Name }}</td>
                </tr>
                <tr>
                    <th>Customer Email :</th>
                    <td>{{ $Rfx->Custom_Email }}</td>
                </tr>
                <tr>
                    <th>Customer Number :</th>
                    <td>{{ $Rfx->Custom_Number }}</td>
                </tr>
                <tr>
                    <th>RFQ Title :</th>
                    <td>{{ $Rfx->RFQ_title }}</td>
                </tr>
                <tr>
                    <th> Due Date : </th>
                    <td> {{ $Rfx->Due_date }} </td>
                </tr>
                <tr>
                    <th> Final Pricing : </th>
                    <td> {{  $Rfx->Quota_mount }} </td>
                </tr>
                <tr>
                    <th> Status: </th>
                    <td> {{  $Rfx->Status }} </td>
                </tr>
                <tr>
                    <th>PIC :</th>
                    <td>{{ $Rfx->user_id }}</td>
                </tr>
                <tr>
                    <th>Remarks :</th>
                    <td>{{ $Rfx->remarks }}</td>
                </tr>
                <tr>
                    <th>Decline Reason (if rejected) :</th>
                    <td>{{ $Rfx->decline }}</td>
                </tr>
                <tr>
                    <th> Award Amount : </th>
                    <td> {{ $Rfx->award_amount }} </td>
                </tr>
                <tr>
                    <th>Date Award:</th>
                    <td>{{ $Rfx->date_award }}</td>
                </tr>
            </table>
            @if($Rfx->documents->isNotEmpty())
                <h5>Uploaded Files:</h5>
                <ul class="file-list">
                    @foreach($Rfx->documents as $document)
                        <li class="file-item">
                            <p>
                                <strong>File:</strong>
                                <a href="{{ asset('storage/' . json_decode($document->file)->path) }}" target="_blank" class="file-link">
                                    {{ json_decode($document->file)->path }}
                                </a>
                            </p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No documents uploaded for this RFx.</p>
            @endif
            <a href="{{ route('rfx.index') }}" class="btn btn-primary btn-back">Back</a>
        </div>
    @endsection
</body>
</html>
