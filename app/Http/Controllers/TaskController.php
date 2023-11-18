<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Task;
use App\Models\User; 

class TaskController extends Controller
{

    public function new()
    {
        $users = User::all(); // Fetch the list of users

        return view('newtasks', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'owner' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'due_date' => 'required|date',
            'subject' => 'required|string|max:255',
            'descrip' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Add this validation rule

        ]);

        $task = Task::create($validatedData);
        
            // Assign the task to the selected user
        $task->assignedUser()->associate($validatedData['user_id']);
        $task->save();

        // Fetch the list of users
        $users = User::all();
        
        return view('user.confirm',  ['users' => $users]); 
    }

    public function index(Request $request)
    {

        $searchTerm = null; // Set the default value for $searchTerm
        // $leads = Lead::all();

        // return view('leads', ['leads' => $leads, 'searchTerm' => $searchTerm]);

        $perPage = 6; // Number of items to display per page
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
    
        $task = Task::skip($offset)->take($perPage)->get();
    
        // Calculate total number of records (for pagination)
        $totalRecords = Task::count();
    
        return view('tasks', [
            'task' => $task,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
            'totalRecords' => $totalRecords,
            'searchTerm' => $searchTerm
        ]);
    }

    public function updateStatus(Request $request, $id)
        {
            $task = Task::findOrFail($id);
            $task->update(['status' => $request->status]);
            // $task->update(['priority' => $request->priority]);

            return redirect()->back()->with('success', 'Status updated successfully.');
        }

    public function updatePriority(Request $request, $id)
        {
            $task = Task::findOrFail($id);
            // $task->update(['status' => $request->status]);
            $task->update(['priority' => $request->priority]);

            return redirect()->back()->with('success', 'Status updated successfully.');
        }

    public function delete($id)
        {
            $task = Task::find($id);
    
            if ($task) {
                $task->delete();
            }
    
            return Redirect::back()->with('success', 'task deleted successfully.');
        }
    
     public function edit($id)
    {
        $task = Task::with('assignedUser')->find($id);

        // Fetch the list of users for the dropdown
        $users = User::all();
    
        return view('edittasks', ['task' => $task, 'users' => $users]);
    }


    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'owner' => 'required|string|max:255',
        'contact' => 'required|string|max:255',
        'due_date' => 'required|date',
        'subject' => 'required|string|max:255',
        'descrip' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id', // Add this validation rule for user_id
    ]);

    $task = Task::find($id);

    if (!$task) {
        return redirect()->route('tasks.index')->with('error', 'Task not found.');
    }

    $task->owner = $validatedData['owner'];
    $task->contact = $validatedData['contact'];
    $task->due_date = $validatedData['due_date'];
    $task->subject = $validatedData['subject'];
    $task->descrip = $validatedData['descrip'];

    // Check if 'user_id' exists in $validatedData before attempting to access it
    if (isset($validatedData['user_id'])) {
        $task->assignedUser()->associate($validatedData['user_id']);
    }

    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}


    public function show($id)
    {
    $task = Task::findOrFail($id);
    
    return view('task_details', compact('task'));
    }
    
//     public function assigntask($id)
//     {
//         $task = Task::find($id);
//         $users = User::all(); // Get all users to display in the assignment form
    
//         return view('assigntask', compact('task', 'users'));
//     }

//     public function assign(Request $request, $id)
// {
//     $validatedData = $request->validate([
//         'user_id' => 'required|exists:users,id',
//         // Other validation rules for assignment
//     ]);


//     $task = Task::findOrFail($id);
//     $task->update(['user_id' => $request->user_id]);

//     return redirect()->back()->with('success', 'Task assigned successfully.');

//     // Redirect or return a response as needed
// }

}
