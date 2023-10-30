<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rfx;


class RfxController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Company' => 'required|string|max:255',
            'Pic' => 'nullable|string|max:255',
            'Custom_Name' => 'required|string|max:255',
            'Custom_Email' => 'required|email|max:255',
            'Custom_Number' => 'required|numeric',
            // 'RFQ_number' => 'required|string|max:255|unique:RFQs', // Make sure 'RFQs' is the correct table name
            'RFQ_title' => 'required|string|max:255',
            'Due_date' => 'required|date',
            'Quota_mount' => 'required|string|max:255',
        ]);

        // Generate RFQ number based on the current timestamp and a unique identifier
        $rfqNumber = 'RQ' . uniqid();

        $rfx = Rfx::create([
            'Company' => $validatedData['Company'],
            'Pic' => $validatedData['Pic'],
            'Custom_Name' => $validatedData['Custom_Name'],
            'Custom_Email' => $validatedData['Custom_Email'],
            'Custom_Number' => $validatedData['Custom_Number'],
            'RFQ_number' => $rfqNumber, // Set the generated RFQ number here
            'RFQ_title' => $validatedData['RFQ_title'],
            'Due_date' => $validatedData['Due_date'],
            'Quota_mount' => $validatedData['Quota_mount'],
        ]);
                
        
        return view('user.confirm'); 
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
    
        return view('RFx', [
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
            ->orWhere('Pic', 'like', '%' . $searchTerm . '%')
            ->orWhere('Custom_Name', 'like', '%' . $searchTerm . '%')
            ->orWhere('Custom_Email', 'like', '%' . $searchTerm . '%')
            ->orWhere('Custom_Number', 'like', '%' . $searchTerm . '%')
            // ->orWhere('RFQ_number', 'like', '%' . $searchTerm . '%')
            ->orWhere('RFQ_title', 'like', '%' . $searchTerm . '%')
            ->orWhere('Due_date', 'like', '%' . $searchTerm . '%')
            ->orWhere('Quota_mount', 'like', '%' . $searchTerm . '%')
            ->get();

            return view('RFx', ['Rfx' => $Rfx, 'searchTerm' => $searchTerm]);
        }

        public function updateStatus(Request $request, $id)
        {
            $Rfx = Rfx::findOrFail($id);
            $Rfx->update(['Status' => $request->status]);

            return redirect()->back()->with('success', 'Status updated successfully.');
        }


    public function delete($id)
    {
        $Rfx = Rfx::find($id);

        if ($Rfx) {
            $Rfx->delete();
        }

        return Redirect::back()->with('success', 'rfq deleted successfully.');
    }

    // public function edit($id)
    // {
    //     $leads = Lead::find($id);


    //     return view('editlead', ['leads' => $leads]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone_number' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'title' => 'required|string|max:255',
    //         'email' => 'required|string|email|unique:leads,email,' . $id . ',id|max:255',
    //         'faxNo' => 'required|string|max:255',
    //         'inv_address' => 'required|string|max:255',
    //         'company' => 'required|string|max:255',
    //     ]);
    
    //     $leads = Lead::find($id);

    
    //     $leads->name = $validatedData['name'];
    //     $leads->email = $validatedData['email'];
    //     $leads->address = $validatedData['address'];
    //     $leads->company = $validatedData['company'];
    //     $leads->phone_number = $validatedData['phone_number'];
    //     $leads->faxNo = $validatedData['faxNo'];
    //     $leads->inv_address = $validatedData['inv_address'];
    //     $leads->title = $validatedData['title'];

    
    //     $leads->save();

    //     return redirect()->route('leads')->with('success', 'Lead updated successfully.');
    // }
}
