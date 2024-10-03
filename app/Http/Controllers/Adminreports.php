<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Barangay;
use App\Models\IncidentType;
use Illuminate\Http\Request;
use App\Models\Reports;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;


class Adminreports extends Controller
{

    public function all_reports()
    {

        $allReports = Reports::orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin-2.reports.all-reports', compact('allReports'));
    }

    public function pending()
    {

        $pending = Reports::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        return view('admin-2.reports.pending', compact('pending'));
    }

    public function resolved()
    {
        $resolved = Reports::where('status', 'resolved')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin-2.reports.resolved', compact('resolved'));
    }

    public function closed()
    {
        $closed = Reports::where('status', 'closed')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('admin-2.reports.closed', compact(var_name: 'closed'));
    }


    public function activitylog()
    {
        $activity = Activity::all();

        return view('admin-2.activity-log', compact('activity'));
    }


    public function filtering(Request $request)
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


        $allReports = $query->paginate(5);

        return view('admin-2.reports.all-reports', compact('allReports'));
    }

    public function filter_pending(Request $request)
    {
        $query = Reports::query();

        if ($request->filled('issue')) {
            $query->where('subject_type', $request->input('issue'));
        }

        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('created_at')) {
            $date = $request->input('created_at');
            $query->whereDate('created_at', '=', $date);
        }

        $pending = $query->where('status', 'pending')->paginate(5, ['*'], 'pending');

        return view('admin-2.reports.pending', compact('pending'));
    }


    public function filter_resolved(Request $request)
    {
        $query = Reports::query();

        if ($request->filled('issue')) {
            $query->where('subject_type', $request->input('issue'));
        }

        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('created_at')) {
            $date = $request->input('created_at');
            $query->whereDate('created_at', '=', $date);
        }

        $resolved = $query->where('status', 'resolved')->paginate(5, ['*'], 'resolved');

        return view('admin-2.reports.resolved', compact('resolved'));
    }



    public function filter_closed(Request $request)
    {
        $query = Reports::query();

        if ($request->filled('issue')) {
            $query->where('subject_type', $request->input('issue'));
        }

        if ($request->filled('location')) {
            $query->where('location', $request->input('location'));
        }

        if ($request->filled('created_at')) {
            $date = $request->input('created_at');
            $query->whereDate('created_at', '=', $date);
        }

        $closed = $query->where('status', 'closed')->paginate(5, ['*'], 'closed');

        return view('admin-2.reports.closed', compact('closed'));
    }


    public function analysis()
    {

        $reportCountByType = Reports::select(DB::raw('count(*) as count, subject_type'))
            ->groupBy('subject_type')
            ->get();


        $reportsByStatus = Reports::select(DB::raw('count(*) as count, status'))
            ->groupBy('status')
            ->get();


        $reportsBySeverity = Reports::select(DB::raw('count(*) as count, severity'))
            ->groupBy('severity')
            ->get();

        $averageResponseTime = Reports::where('status', 'resolved')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_response_time'))
            ->first();


        return view('admin-2.analysis', compact('reportCountByType', 'reportsByStatus', 'reportsBySeverity', 'averageResponseTime'));
    }


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


        $admins = User::where('role', 2)->get();

        if (Auth::check()) {
            switch ($status) {
                case 'resolved':
                    $data->status = 'resolved';
                    $message = 'Report marked as resolved successfully.';
                    Notification::send($user, new Notifications('Your report has been resolved.'));
                    foreach ($admins as $admin) {
                        Notification::send($admin, new Notifications('A report has been resolved.'));
                    }
                    break;
                case 'closed':
                    $data->status = 'closed';
                    $message = 'Report closed.';
                    Notification::send($user, new Notifications('Your report has been closed.'));
                    foreach ($admins as $admin) {
                        Notification::send($admin, new Notifications('A report has been closed.'));
                    }
                    break;
                default:
                    return redirect()->back()->withErrors(['Invalid action.']);
            }

            $data->save();

            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->withErrors(['Unauthorized action.']);
    }

    public function incident()
    {
        return view('admin-2.add.add-incident');
    }


    public function add_incident(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:7',
        ]);


        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        IncidentType::create([
            'name' => $request->name,
            'image' => $imageName,
            'color' => $request->color,
        ]);


        return redirect()->route('admin-2.incident')->with('success', 'Incident added successfully!');
    }

    public function barangay()
    {
        return view('admin-2.add.add-barangay');
    }


    public function add_barangay(Request $request)
    {

        $request->validate([
            'barangay' => 'required|string|max:255',
        ]);

        Barangay::create([
            'barangay' => $request->barangay,
        ]);

        return redirect()->route('admin-2.barangay')->with('success', '');
    }
}