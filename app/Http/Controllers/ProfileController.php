<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validation and update logic here
        return back()->with('status', 'Profile updated!');
    }
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = $request->user();
    $user->update([
        'password' => bcrypt($request->password),
    ]);

    return back()->with('status', 'Password updated!');
}

}