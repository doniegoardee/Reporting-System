<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{


    public function user(Request $request)
    {
        $query = $request->input('query');
        $usersQuery = User::where('role', 0);
        if ($request->ajax()) {


            $nameSuggestions = $usersQuery->where('name', 'LIKE', "%{$query}%")->get();
            $emailSuggestions = $usersQuery->where('email', 'LIKE', "%{$query}%")->get();

            $output = '<ul class="list-group">';

            if ($nameSuggestions->isNotEmpty()) {
                foreach ($nameSuggestions as $user) {
                    $output .= '<li class="list-group-item suggestion name-suggestion">' . $user->name . '</li>';
                }
            }

            if ($emailSuggestions->isNotEmpty()) {
                foreach ($emailSuggestions as $user) {
                    $output .= '<li class="list-group-item suggestion email-suggestion">' . $user->email . '</li>';
                }
            }

            if ($output === '<ul class="list-group"></ul>') {
                $output .= '<li class="list-group-item">No results found</li>';
            }

            $output .= '</ul>';

            return response()->json(['html' => $output]);
        }

        if ($query) {
            $usersQuery = $usersQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%");
            });
        }

        $users = $usersQuery->get();

        return view('admin-2.users.user', compact('users'));
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


    public function activitylog()
    {
        $activity_types = [
            'App\Models\User' => 'User Module',
            'App\Models\Reports' => 'Reports Module',
        ];

        $logs = Activity::with('subject', 'causer')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-2.activity-log', compact('logs', 'activity_types'));
    }
}
