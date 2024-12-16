<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Seminars;
use Illuminate\Http\Request;

class SeminarController extends Controller
{


    public function index(){

        $seminar = Seminars::all();

        return view('admin-2.seminars.seminar',compact('seminar'));
    }

    public function add_seminar()
    {
        return view('admin-2.seminars.add-seminar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
        ]);

        Seminars::create($validated);

        // Redirect to the 'add-seminar' route
        return redirect()->route('admin-2.add-seminar')->with('success', 'Seminar created successfully!');
    }

}
