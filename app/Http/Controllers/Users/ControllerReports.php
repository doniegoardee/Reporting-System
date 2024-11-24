<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\IncidentType;
use App\Models\Reports;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class ControllerReports extends Controller
{


    public function index()
    {
        $reports = Reports::where('status', 'requested')->paginate(10);
        return view('admin.reports.manage-reports', compact('reports'));
    }

    public function status(Request $request)
    {

        $query = Reports::query();


        if ($request->filled('report')) {
            $query->where('subject_type', $request->input('report'));
        }

        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('created_at')) {
            $date = $request->input('created_at');
            $query->whereDate('created_at', '=', $date);
        }


        $pendingQuery = clone $query;
        $solvedQuery = clone $query;
        $rejectedQuery = clone $query;


        $pending = $pendingQuery->where('status', 'pending')->paginate(5, ['*'], 'pending');

        $solved = $solvedQuery->where('status', 'solved')->paginate(5, ['*'], 'solved');

        $rejected = $rejectedQuery->where('status', 'reject')->paginate(5, ['*'], 'rejected');


        return view('admin.reports.pending-solved', compact('pending', 'solved', 'rejected'));
    }



    public function myreports()
    {

        $user = Auth::user();
        $userid = $user->id;


        $data = Reports::where('user_id', $userid)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('users.my-reports', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function incident()
    {
        $incidentTypes = IncidentType::all();
        return view('users.incident-type', compact('incidentTypes'));
    }

    public function create($subject_type)
    {
        $barangay = Barangay::all();
        return view('users.create-reports', compact('subject_type', 'barangay'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userid = $user->id;

            $username = $user->name;
            $contact = $user->contact;
            $email = $user->email;

            if ($request->has('addAsterisk')) {
                $username = '*****';
                $email = '*****';
            }

            $reports = new Reports;

            $reports->user_id = $userid;
            $reports->subject_type = $request->subject_type;
            $reports->status = 'pending';
            $reports->location = $request->location;
            $reports->description = $request->details;
            $reports->severity = $request->severity;
            $reports->num_affected = $request->num_affected;
            $reports->needs = $request->needs;

            $reports->name = $username;
            $reports->email = $email;
            $reports->contact = $contact;


            $image = $request->image;

            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move(public_path('/image'), $imagename);
                $reports->image = $imagename;
            }

            $reports->save();

            return redirect()->back()->with('message', 'Report added successfully');
        }
    }



    /**
     * Display the specified resource.
     */

    public function updateStatus($id, $status, Request $request)
    {
        $data = Reports::find($id);

        if (!$data) {
            return redirect()->back()->withErrors(['Report not found.']);
        }

        $user = User::find($data->user_id);
        if (!$user) {
            return redirect()->back()->withErrors(['User not found.']);
        }

        if (Auth::check()) {
            switch ($status) {
                case 'pending':
                    $data->status = 'pending';
                    $message = 'Report approved successfully.';
                    Notification::send($user, new Notifications('Your report has been approved.'));
                    break;
                case 'solved':
                    $data->status = 'solved';
                    $message = 'Report marked as solved successfully.';
                    Notification::send($user, new Notifications('Your report has been solved.'));
                    break;
                case 'reject':
                    $data->status = 'reject';
                    $message = 'Report rejected.';
                    Notification::send($user, new Notifications('Your report has been rejected.'));
                    break;
                default:
                    return redirect()->back()->withErrors(['Invalid action.']);
            }

            $data->save();

            return redirect()->back()->with('success', $message);
        }
    }

    public function editReport($id)
    {
        $report = Reports::findOrFail($id);
        $incidentTypes = IncidentType::all();
        $barangay = Barangay::all();
        return view('users.edit-report', compact('report', 'incidentTypes', 'barangay'));
    }


    public function updateReports(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject_type' => 'required',
            'location' => 'required',
            'description' => 'required',
            'severity' => 'required',
            'num_affected' => 'required|integer|min:0',
            'needs' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $report = Reports::findOrFail($id);
        $report->subject_type = $validatedData['subject_type'];
        $report->location = $validatedData['location'];
        $report->description = $validatedData['description'];
        $report->severity = $validatedData['severity'];
        $report->num_affected = $validatedData['num_affected'];
        $report->needs = $validatedData['needs'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/image'), $imagename);
            $report->image = $imagename;
        }

        $report->save();

        return redirect()->route('user.report')->with('success', 'Report updated successfully.');
    }
}
