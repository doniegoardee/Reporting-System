<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Profile extends Controller
{
    public function agency_profile()
    {
        return view('agency.edit');
    }

    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = User::find(auth()->id());

    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->hasFile('profile_image')) {
        // Delete old image if not the default
        if ($user->profile_image && $user->profile_image !== 'image/default-avatar.png') {
            if (file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }
        }

        // Save the new image with a unique name
        $file = $request->file('profile_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('image'), $filename);

        $user->profile_image = 'image/' . $filename;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully!');
}



    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(auth()->id());

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully!');
    }


}
