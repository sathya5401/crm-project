<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class ClientInquiryController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('inquiry.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $inquiry = Inquiry::create($validatedData);

        return redirect('/')->with('success', 'Inquiry submitted successfully.');
    }
}
