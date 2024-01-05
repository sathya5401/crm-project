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
    
    public function index()
    {
        $inquiries = Inquiry::all();

        return view('support.inquiries', compact('inquiries'));
    }
}

