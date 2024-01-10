<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class SupportInquiryController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $inquiries = Inquiry::query(); // Create a query builder instance

        if ($request->has('status') && $request->status != '') {
            $inquiries->where('status', $request->status); // Use the where method on $inquiries
        }

        $inquiries = $inquiries->get(); // Execute the query and retrieve the results

        return view('inquiry.listing', compact('inquiries'));
    }

}

