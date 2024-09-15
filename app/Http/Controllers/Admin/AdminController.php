<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function userindex(Request $request)
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

        return view('user-barangay.user-table', compact('users', 'admins'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function activitylog()
    {
        $activity = Activity::all();

        return view('admin.activity-log', compact('activity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}