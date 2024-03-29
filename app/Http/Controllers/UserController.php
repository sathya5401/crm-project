<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Mail\RegistrationEmail;


class UserController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        if ( (Auth::user()->is_admin) === 1)  {
            abort(403); // Return a 403 Forbidden response if normal user tries to access user listing
        }
        return view('user.register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            'branch' => $validatedData['branch'],
            'phone_number' => $validatedData['phone_number'],
            'is_admin' => 1, // Set the role for the new user as 1 (normal user)
            
        ]);

        return redirect()->route('user.listing')->with('success', 'User created successfully.');
    }

    public function index(Request $request)
{
    if (Auth::user()->is_admin === 1) {
        abort(403);
    }

    $searchTerm = null;
    $users = User::where('is_admin', 1);

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $users = $users->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('role', 'like', '%' . $searchTerm . '%')
                ->orWhere('branch', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
        });
    }

    $perPage = 6;
    $currentPage = $request->input('page', 1);
    $offset = ($currentPage - 1) * $perPage;

    $totalRecords = $users->count();
    $users = $users->skip($offset)->take($perPage)->get();

    return view('user.listing', [
        'users' => $users,
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'searchTerm' => $searchTerm
    ]);
}

public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $users = User::where('is_admin', 1)
        ->where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%')
                ->orWhere('role', 'like', '%' . $searchTerm . '%')
                ->orWhere('branch', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
        })
        ->get();

    $perPage = 6;
    $currentPage = $request->input('page', 1);
    $offset = ($currentPage - 1) * $perPage;

    $totalRecords = $users->count();
    $users = $users->skip($offset)->take($perPage)->get();

    return view('user.listing', [
        'users' => $users,
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'totalRecords' => $totalRecords,
        'searchTerm' => $searchTerm
    ]);
}


    public function delete($id)
    {
        if (Auth::user()->is_admin === 1) {
            abort(403); // Return a 403 Forbidden response if a normal user tries to delete a user
        }

        $user = User::find($id);

        if ($user) {
            $user->delete();
        }

        return Redirect::back()->with('success', 'User deleted successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // User not found
        }

        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,'.$id.'|max:255',
        'role' => 'nullable|string|max:255',
        'branch' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:255',
        // Add validation rules for other fields
    ]);

    $user = User::find($id);

    if (!$user) {
        abort(404); // User not found
    }

    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->role = $validatedData['role'];
    $user->branch = $validatedData['branch'];
    $user->phone_number = $validatedData['phone_number'];
    // Update other user fields

    $user->save();

    return redirect()->route('user.listing')->with('success', 'User updated successfully.');
}

    public function show($id)
    {
    $user = User::findOrFail($id);

    return view('user.details', compact('user'));
    }

    public function permission($id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // User not found
        }

        return view('user.permission', ['user' => $user]);
    }

    public function updatePermission(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404); // User not found
        }

        // Update user flags based on checkbox values
        $user->can_create_leads = $request->has('lead_create');
        $user->can_delete_leads = $request->has('lead_delete');
        $user->can_edit_leads = $request->has('lead_edit');
        $user->can_create_rfx = $request->has('rfx_create');
        $user->can_delete_rfx = $request->has('rfx_delete');
        $user->can_edit_rfx = $request->has('rfx_edit');
        $user->can_connect_rfqs_data = $request->has('connect_rfx');
        $user->can_connect_leads_data = $request->has('connect_leads');
        $user->can_download_data = $request->has('download_data');
        $user->can_create_custom = $request->has('customer_create');
        $user->can_delete_custom = $request->has('customer_delete');
        $user->can_edit_custom = $request->has('customer_edit');
        $user->can_send_email = $request->has('send_email');
        $user->can_create_meeting = $request->has('create_meeting');
        $user->save();

        return redirect()->route('user.listing')->with('success', 'User updated successfully.');
    }


}