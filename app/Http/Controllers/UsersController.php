<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function user(Request $request)
    {

        $query = $request->input('query');
        $usersQuery = User::where('role', 0);
        $admins = User::where('role', 1)->get();

        if ($query) {
            $usersQuery = $usersQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            });
        }

        $users = $usersQuery->get();

        return view('admin-2.users.user', compact('users', 'admins'));
    }


    public function add_user()
    {
        return view('admin-2.users.add-user');
    }

    public function register_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $imagePath = 'image/default-avatar.png';
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $filename);
            $imagePath = 'image/' . $filename;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
            'profile_image' => $imagePath,
        ]);

        return redirect()->route('admin-2.add_user')->with('success', 'User added successfully');
    }


    public function settings()
    {
        return view('admin-2.settings.settings');
    }

    public function user_settings()
    {
        return view('users.settings');
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