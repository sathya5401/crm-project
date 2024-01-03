<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Add this use statement
use Illuminate\Http\Request;
use App\Models\Inquiry;
use App\Models\User; 

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
}
