<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\IncidentType;
use App\Models\Reports;
use Illuminate\Http\Request;


class LpageController extends Controller
{


    public function index()
    {
        $report = Reports::all();
        $incident = IncidentType::all();
        $barangay = Barangay::all();
        return view('welcome', compact('report', 'incident', 'barangay'));
    }

    public function store(Request $request){

        $request->validate([
            'subject_type' => 'required|string',
            'location' => 'required|string',
            'severity' => 'required|string|in:low,medium,high',
            'num_affected' => 'nullable|integer|min:0',
            'details' => 'required|string',
            'needs' => 'nullable|string',
            'contact' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $reports = new Reports();
            $reports->subject_type = $request->subject_type;
            $reports->status = 'pending';
            $reports->location = $request->location;
            $reports->description = $request->details;
            $reports->severity = $request->severity;
            $reports->num_affected = $request->num_affected ?? 0;
            $reports->needs = $request->needs ?? '';
            $reports->contact = $request->contact;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image'), $imageName);
                $reports->image = $imageName;
            }

            $reports->save();

            return redirect()->back()->with('success', 'Report submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while submitting the report: ' . $e->getMessage());
        }


    }
}
