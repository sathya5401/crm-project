<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|string|email|unique:leads|max:255',
            'faxNo' => 'required|string|max:255',
            'inv_address' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ]);

        $lead = Lead::create($validatedData);
        
        return view('user.confirm'); 
    }

    public function index(Request $request)
    {

        $searchTerm = null; // Set the default value for $searchTerm
        // $leads = Lead::all();

        // return view('leads', ['leads' => $leads, 'searchTerm' => $searchTerm]);

        $perPage = 6; // Number of items to display per page
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
    
        $leads = Lead::skip($offset)->take($perPage)->get();
    
        // Calculate total number of records (for pagination)
        $totalRecords = Lead::count();
    
        return view('leads', [
            'leads' => $leads,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'totalRecords' => $totalRecords,
            'searchTerm' => $searchTerm
        ]);
    }

    public function search(Request $request)
    {
    $searchTerm = $request->input('search');
    $leads = null;
    
    $leads = Lead::query()
        ->where('name', 'like', '%' . $searchTerm . '%')
        ->orWhere('email', 'like', '%' . $searchTerm . '%')
        ->orWhere('title', 'like', '%' . $searchTerm . '%')
        ->orWhere('faxNo', 'like', '%' . $searchTerm . '%')
        ->orWhere('phone_number', 'like', '%' . $searchTerm . '%')
        ->orWhere('company','like','%'. $searchTerm . '%' )
        ->get();

    $perPage = 6; // Number of items to display per page
    $currentPage = $request->input('page', 1);
    $offset = ($currentPage - 1) * $perPage;
    
    // $leads = Lead::skip($offset)->take($perPage)->get();
    
    // Calculate total number of records (for pagination)
    $totalRecords = Lead::count();
    return view('leads', [
        'leads' => $leads,
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'searchTerm' => $searchTerm
    ]);
    }

    public function delete($id)
    {
        $leads = Lead::find($id);

        if ($leads) {
            $leads->delete();
        }

        return Redirect::back()->with('success', 'Lead deleted successfully.');
    }

    public function edit($id)
    {
        $leads = Lead::find($id);


        return view('editlead', ['leads' => $leads]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|string|email|unique:leads,email,' . $id . ',id|max:255',
            'faxNo' => 'required|string|max:255',
            'inv_address' => 'required|string|max:255',
            'company' => 'required|string|max:255',
        ]);
    
        $leads = Lead::find($id);

    
        $leads->name = $validatedData['name'];
        $leads->email = $validatedData['email'];
        $leads->address = $validatedData['address'];
        $leads->company = $validatedData['company'];
        $leads->phone_number = $validatedData['phone_number'];
        $leads->faxNo = $validatedData['faxNo'];
        $leads->inv_address = $validatedData['inv_address'];
        $leads->title = $validatedData['title'];

    
        $leads->save();

        return redirect()->route('leads')->with('success', 'Lead updated successfully.');
    }

}
