<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
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

        return view('user.confirm');    }

    public function index()
    {
        if ( (Auth::user()->is_admin) === 1)  {
            abort(403); // Return a 403 Forbidden response if normal user tries to access user listing
        }

        $searchTerm = null; // Set the default value for $searchTerm
        $users = User::where('is_admin', 1)->get(); // Retrieve only normal users (is_admin = 1)

        return view('user.listing', ['users' => $users, 'searchTerm' => $searchTerm]);
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $users = null;

    if ($searchTerm) {
        $users = User::where('is_admin', 1)
                      ->where(function ($query) use ($searchTerm) {
                          $query->where('name', 'like', '%'.$searchTerm.'%')
                                ->orWhere('email', 'like', '%'.$searchTerm.'%')
                                ->orWhere('role', 'like', '%'.$searchTerm.'%')
                                ->orWhere('branch', 'like', '%'.$searchTerm.'%')
                                ->orWhere('phone_number', 'like', '%'.$searchTerm.'%');
                      })
                      ->get();
    } else {
        $users = User::where('is_admin', 1)->get();
    }

    return view('user.listing', ['users' => $users, 'searchTerm' => $searchTerm]);
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




}