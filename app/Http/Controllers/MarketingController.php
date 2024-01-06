<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Rfx;
use App\Models\Meeting;
use App\Models\User;


class MarketingController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    }

    public function deals()
    {
        $deals = Rfx::whereIn('Status', ['new', 'in-progress'])->get();

        return view('marketing.deals',['deals' => $deals]);
    }

    public function meeting() {

        $meeting = Meeting::orderBy('created_at', 'desc')->get(); // Sort by creation date, newest first
        return view('marketing.meeting', compact('meeting'));
    }

    public function createMeeting() {

        $users = User::all();
        return view('marketing.newmeeting', compact('users'));    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
            'host_id' => 'required|exists:users,id',
            'participants' => 'required|array',
            'participants.*' => 'exists:users,id',
        ]);

        $meeting = Meeting::create([
            'title' => $validatedData['title'],
            'location' => $validatedData['location'],
            'from' => $validatedData['from'],
            'to' => $validatedData['to'],
            'host_id' => $validatedData['host_id'],
        ]);

        // Sync participants
        $meeting->participants()->sync($validatedData['participants']);

        return redirect()->route('meeting')->with('success', 'Meeting created successfully.');  
      }
}
