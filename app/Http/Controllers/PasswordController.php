<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Add this use statement

use App\Models\User;

class PasswordController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSetPasswordForm($token)
    {
        // Validate the token and display the password setting form
        $user = User::where('password_reset_token', $token)->first();

        if (!$user) {
            abort(404); // Token is invalid
        }

        return view('user.set-password', ['token' => $token]);
    }

    public function setPassword(Request $request, $token)
    {
        // Validate the token and update the user's password
        $user = User::where('password_reset_token', $token)->first();

        if (!$user) {
            abort(404); // Token is invalid
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->input('password')),
            'password_reset_token' => null, // Clear the token after password is set
        ]);

        return redirect()->route('user.listing')->with('success', 'Password set successfully.');
    }

    public function showChangeForm()
    {   
        $user = Auth::user();

        return view('user.newuser',['user' => $user]);
    }

    public function change(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Update the user's password
        auth()->user()->update([
            'password' => Hash::make($request->password),
            'first_login' => false,
        ]);

        // Redirect the user after password change
        return redirect()->route('home')->with('success', 'Password changed successfully!');
    }

}
