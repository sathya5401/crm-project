<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Add this use statement
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Task;
use App\Models\Rfx;



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

        return view('home', ['user' => $user, 'tasks' => $tasks, 'rfx' => $rfx]);
    }
}
