<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rfx;
use App\Models\User; 
use App\Models\Document;
use App\Models\Customers; 



class RfxController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function new()
    {
        $user = Auth::user();

        if (!$user->can_create_rfx) {
            return view('errors.permission')->with('message', 'You do not have permission to create proposals.');
        }

        $customers = Customers::all();
        $users = User::all(); // Fetch the list of users

        return view('rfx.newRFx', ['users' => $users, 'customers' => $customers]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Company' => 'required|string|max:255',
            // 'Pic' => 'nullable|string|max:255',
            'Custom_Name' => 'required|string|max:255',
            'Custom_Email' => 'required|email|max:255',
            'Custom_Number' => 'required|numeric',
            // 'RFQ_number' => 'required|string|max:255|unique:RFQs', // Make sure 'RFQs' is the correct table name
            'RFQ_title' => 'required|string|max:255',
            'Due_date' => 'required|date',
            'Quota_mount' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Add this validation rule
            'rfx_type' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:255', 
            'decline' => 'nullable|string|max:255', 
            'date_award' => 'nullable|date', 
            'award_amount' => 'nullable|numeric',
            'Status' => 'nullable|string|max:255',
            // 'document_name' => 'nullable|string|max:255',
            // 'document_type' => 'nullable|string|max:255',
            // 'file.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Adjust allowed file types and size

        ]);

        // Generate RFQ number based on the current timestamp and a unique identifier
        $rfqNumber = 'RQ' . uniqid();

        $rfx = Rfx::create([
            'Company' => $validatedData['Company'],
            // 'Pic' => $validatedData['Pic'],
            'Custom_Name' => $validatedData['Custom_Name'],
            'Custom_Email' => $validatedData['Custom_Email'],
            'Custom_Number' => $validatedData['Custom_Number'],
            'RFQ_number' => $rfqNumber, // Set the generated RFQ number here
            'RFQ_title' => $validatedData['RFQ_title'],
            'Due_date' => $validatedData['Due_date'],
            'Quota_mount' => $validatedData['Quota_mount'],
            'user_id' => $validatedData['user_id'],
            'rfx_type' => $validatedData['rfx_type'], 
            'remarks' => $validatedData['remarks'], 
            'decline' => $validatedData['decline'], 
            'date_award' => $validatedData['date_award'],
            'award_amount' => $validatedData['award_amount'],
            'Status' => $validatedData['Status'],
            // 'document_name' => $validatedData['document_name'],
            // 'document_type' => $validatedData['document_type'],
            // 'file.*' => $validatedData['file.*'],
        ]);

            // Handle file uploads and associate them with the RFx as documents
            foreach ($request->file('file') as $key => $file) {
                $filename = $file->getClientOriginalName();
                $filePath = $file->storeAs('files', $filename, 'public');

                // Create associated Document for each file
                $document = new Document([
                    'document_name' => $request->input('document_name')[$key] ?? null,
                    'document_type' => $request->input('document_type')[$key] ?? null,
                    'file' => json_encode(['path' => $filePath]),
                ]);

                // Associate the Document with the RFx
                $rfx->documents()->save($document);
            }
                
        $rfx->assignedUser()->associate($validatedData['user_id']);
        $rfx->save();

        // Fetch the list of users
        $users = User::all();
        
        return redirect()->route('rfx.index')->with('success', 'Rfx created successfully.');
    }

    public function index(Request $request)
    {

        $searchTerm = null; // Set the default value for $searchTerm
        // $Rfx = Rfx::all();
        // $Rfx = Rfx::paginate(6);

        // return view('RFx', ['Rfx' => $Rfx, 'searchTerm' => $searchTerm]);

        $perPage = 6; // Number of items to display per page
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
    
        $Rfx = Rfx::skip($offset)->take($perPage)->get();
    
        // Calculate total number of records (for pagination)
        $totalRecords = Rfx::count();
    
        return view('rfx.RFx', [
            'Rfx' => $Rfx,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'totalRecords' => $totalRecords,
            'searchTerm' => $searchTerm
        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $Rfx = null;
        
        $Rfx = Rfx::query()
            ->where('Company', 'like', '%' . $searchTerm . '%')
            ->orWhere('Custom_Name', 'like', '%' . $searchTerm . '%')
            ->orWhere('Custom_Email', 'like', '%' . $searchTerm . '%')
            ->orWhere('Custom_Number', 'like', '%' . $searchTerm . '%')
            // ->orWhere('RFQ_number', 'like', '%' . $searchTerm . '%')
            ->orWhere('RFQ_title', 'like', '%' . $searchTerm . '%')
            ->orWhere('Due_date', 'like', '%' . $searchTerm . '%')
            ->orWhere('Quota_mount', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('assignedUser', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        $perPage = 6; // Number of items to display per page
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        
        // $Rfx = Rfx::skip($offset)->take($perPage)->get();  
        // Calculate total number of records (for pagination)
        $totalRecords = Rfx::count();

        return view('rfx.RFx', [
            'Rfx' => $Rfx,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'totalRecords' => $totalRecords,
            'searchTerm' => $searchTerm
        ]);
        }

        public function updateStatus(Request $request, $id)
        {
            $Rfx = Rfx::findOrFail($id);
            $Rfx->update(['Status' => $request->status]);

            return redirect()->back()->with('success', 'Status updated successfully.');
        }


    public function delete($id)
    {
        $user = Auth::user();

        if (!$user->can_delete_rfx) {
            return view('errors.permission')->with('message', 'You do not have permission to delete proposals.');
        }

        $Rfx = Rfx::find($id);

        if ($Rfx) {
            $Rfx->delete();
        }

        return Redirect::back()->with('success', 'rfq deleted successfully.');
    }

    public function edit($id)
    {
        $user = Auth::user();

        if (!$user->can_edit_rfx) {
            return view('errors.permission')->with('message', 'You do not have permission to edit proposals.');
        }

        $customers = Customers::all();
        $Rfx = Rfx::find($id);
        $users = User::all();
        $documents = $Rfx->documents; // Retrieve associated documents
    
        return view('rfx.editRfx', ['Rfx' => $Rfx, 'users' => $users, 'documents' => $documents, 'customers' => $customers]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Company' => 'required|string|max:255',
            'Custom_Name' => 'required|string|max:255',
            'Custom_Email' => 'required|email|max:255',
            'Custom_Number' => 'required|numeric',
            'RFQ_title' => 'required|string|max:255',
            'Due_date' => 'required|date',
            'Quota_mount' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Add this validation rule
            'rfx_type' => 'required|string|max:255',
            'remarks' => 'nullable|string|max:255', 
            'decline' => 'nullable|string|max:255', 
            'date_award' => 'nullable|date', 
            'award_amount' => 'nullable|numeric',
            'Status' => 'nullable|string|max:255',
        ]);
    
        $Rfx = Rfx::find($id);
    
        if (!$Rfx) {
            return redirect()->route('rfx.index')->with('error', 'Rfx not found.');
        }
        
        $Rfx->Company = $validatedData['Company'];
        $Rfx->Custom_Name = $validatedData['Custom_Name'];
        $Rfx->Custom_Email = $validatedData['Custom_Email'];
        $Rfx->Custom_Number = $validatedData['Custom_Number'];
        $Rfx->RFQ_title = $validatedData['RFQ_title'];
        $Rfx->Due_date = $validatedData['Due_date'];
        $Rfx->Quota_mount = $validatedData['Quota_mount'];
        $Rfx->user_id = $validatedData['user_id'];
        $Rfx->rfx_type = $validatedData['rfx_type']; 
        $Rfx->remarks = $validatedData['remarks'];
        $Rfx->decline = $validatedData['decline']; 
        $Rfx->date_award = $validatedData['date_award'];
        $Rfx->award_amount = $validatedData['award_amount'];
        $Rfx->Status = $validatedData['Status'];

        // Remove deleted documents
        if ($request->has('delete_documents')) {
            foreach ($request->delete_documents as $documentId) {
                $document = Document::find($documentId);
                if ($document) {
                    $document->delete();
                }
            }
        }

        // Update documents if files are provided
        if ($request->hasFile('file')) {
            // Handle file uploads and associate them with the RFx as documents
            foreach ($request->file('file') as $key => $file) {
                $filename = $file->getClientOriginalName();
                $filePath = $file->storeAs('files', $filename, 'public');

                // Create associated Document for each file
                $document = new Document([
                    'document_name' => $request->input('document_name')[$key] ?? null,
                    'document_type' => $request->input('document_type')[$key] ?? null,
                    'file' => json_encode(['path' => $filePath]),
                ]);

                // Associate the Document with the RFx
                $Rfx->documents()->save($document);
            }
        }

        $Rfx->assignedUser()->associate($validatedData['user_id']);
        $Rfx->save();
    
        return redirect()->route('rfx.index')->with('success', 'Rfx updated successfully.');
    }

    public function show($id)
    {
    $Rfx = Rfx::find($id);
    $documents = $Rfx->documents; // Retrieve associated documents

    
    return view('rfx.rfxdetails', compact('Rfx', 'documents'));
    }
}
