<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth; // Add this use statement
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User; 
use App\Models\Remarks; 

class ClientInquiryController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        
        $user = Auth::user();
        $inquiry = Inquiry::where('name', $user->name )->get();
        $inquiries = Inquiry::all();
        return view('inquiry.listing',['inquiry'=> $inquiry, 'inquiries' =>  $inquiries]);
    }
    public function create()
    {
        $user = Auth::user();
        return view('inquiry.create',['user' => $user]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $inquiry = Inquiry::create($validatedData);

        return redirect('/inquiry')->with('success', 'Inquiry submitted successfully.');
    }

    public function show($id)
    {   
        $user = Auth::user();
        $inquiry = Inquiry::findOrFail($id);
        $remarks = $inquiry->remarks;

        return view('inquiry.details', ['inquiry' => $inquiry, 'remarks' => $remarks, 'user' => $user]);
    }

    public function updateStatus(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->update(['status' => $request->status]);

        return Redirect::back()->with('success', 'Inquiry updated successfully.');
    }

    public function storeRemarks(Request $request, $id)
    {
        $remarksData = $request->validate([
            'comment' => 'required',
        ]);

        $user = Auth::user();
        $remarksData['inquiry_id'] = $id;

        Remarks::create($remarksData);

        return redirect()->back()->with('success', 'Remark submitted successfully.');
    }

    public function inquiryData(){

        $inquiries = Inquiry::all()->count();
        $solved = Inquiry::where('status', 'completed')->count();
        $pending = Inquiry::where('status', [ 'new', 'in-progress'])->count();

        return view('inquiry.data', ['inquiries' => $inquiries, 'solved' => $solved , 'pending' => $pending]);
    }

}
