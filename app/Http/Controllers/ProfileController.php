<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user profile.
     *
     * @return View
     */
    public function show()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('user_profile', ['user' => $user]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'address' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->name = $validated['name'];
        $user->phone_number = $validated['phone_number'];
        $user->address = $validated['address'];
        $user->save();

        // Redirect to the home page after profile update
        return redirect('/')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function delete() {
        $user = Auth::user();

        // Logout the user
        Auth::logout();

        // Delete the user account
        if ($user) {
            DB::table('users')->where('id', $user->id)->delete();
        }

        // Redirect to the homepage after account deletion
        return redirect('/')->with('status', 'Your account has been deleted.');
    }
}
