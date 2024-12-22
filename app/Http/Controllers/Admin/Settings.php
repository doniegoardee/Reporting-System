<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Settings extends Controller
{
    public function settings()
    {
        return view('admin.settings.settings');
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
            if ($user->profile_image && $user->profile_image !== 'image/default-avatar.png') {
                $oldImagePath = public_path('image/' . $user->profile_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('profile_image');
            $filename = $file->getClientOriginalName();
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

    public function deleteAccount(Request $request)
    {
        $user = User::find(auth()->id());

        $user->delete();

        auth()->logout();


        return redirect('/')->with('success', 'Your account has been deleted successfully.');
    }
}
