<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PasswordController extends Controller
{
    //
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
}
