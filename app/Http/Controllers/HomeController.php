<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Add this use statement
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Task;
use App\Models\Rfx;
use App\Models\Meeting;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)
                        ->where('status', 'open')
                        ->get();
        $rfx = Rfx::where('user_id', $user->id)
                    ->whereIn('Status',['new', 'in-progress',]) 
                    ->get();
        
        // Fetch upcoming meetings
        $upcomingMeetings = Meeting::where(function ($query) use ($user) {
            // Include meetings where the authenticated user is a participant
            $query->whereHas('participants', function ($innerQuery) use ($user) {
                $innerQuery->where('user_id', $user->id);
            })
            // Include meetings where the authenticated user is the host
            ->orWhere('host_id', $user->id);
        })
        ->where('to', '>=', now())
        ->orderBy('from')
        ->get();

        return view('home', ['user' => $user, 'tasks' => $tasks, 'rfx' => $rfx, 'upcomingMeetings' => $upcomingMeetings,]);
    }
}
