<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function picture(Request $request)
    {
        // Validate the uploaded picture
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp'],
        ]);

        // Get the authenticated user
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('failure', 'You must be logged in to update your picture.');
        }

        // Define the target directory for storing images
        $target_directory = 'template/img/profile-photo/';

        // Check if the user has an existing picture and delete it if it exists
        $old_picture_path = $target_directory . $user->picture;
        if ($user->picture && File::exists(public_path($old_picture_path))) {
            unlink(public_path($old_picture_path));
        }

       $new_file_name = $user->name . "." . $request->file('picture')->getClientOriginalExtension();

        $request->file('picture')->move(public_path($target_directory), $new_file_name);


        $data = [
            'picture' => $new_file_name,
        ];

        if ($user->update($data)) {
            return redirect()->back()->with('success', 'Profile picture has been updated!');
        } else {
            return redirect()->back()->with('failure', 'Unable to update the picture, please try again!');
        }
    }



}
