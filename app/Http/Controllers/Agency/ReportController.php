<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use App\Models\IncidentType;
use App\Models\Barangay;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{


    public function agency_record()
    {
        $user = Auth::user();
        $userAgency = $user->agency;

        $reports = Reports::where('responding_agency', $userAgency)
            ->whereIn('status', ['resolved', 'closed'])
            ->orderByRaw("FIELD(status, 'resolved', 'closed')")
            ->paginate(10);

        return view('agency.records', compact('reports', 'userAgency'));
    }



    public function markasresolved($id, $status, Request $request)
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

        $incidentType = IncidentType::where('name', $data->subject_type)->first();
        $agency = $incidentType ? $incidentType->agency : 'N/A';
        if (Auth::check()) {
            $message = '';

            switch ($status) {
                case 'resolved':
                    if ($data->status === 'resolved') {
                        return redirect()->back()->withErrors(['Report is already resolved.']);
                    }
                    $data->status = 'resolved';
                    $data->responding_agency = $agency;
                    $data->resolved_time = $request->input('resolved_time') ? Carbon::parse($request->input('resolved_time')) : null;
                    $message = 'Report marked as resolved successfully.';

                    Notification::send($user, new Notifications('Your report has been resolved.'));
                    foreach ($admins as $admin) {
                        Notification::send($admin, new Notifications('A report has been resolved.'));
                    }

                    activity()
                        ->causedBy(auth()->user())
                        ->performedOn($data)
                        ->log('Report Resolved');
                    break;

                default:
                    return redirect()->back()->withErrors(['Invalid action.']);
            }
            $data->save();

            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->withErrors(['Unauthorized action.']);
    }


    public function analysis()
    {
        $user = auth()->user();
        $userAgency = $user->agency;

        $inProgressCount = Reports::where('responding_agency', $userAgency)
            ->where('status', 'in-progress')
            ->count();

        $resolvedCount = Reports::where('responding_agency', $userAgency)
            ->where('status', 'resolved')
            ->count();

        $closedCount = Reports::where('responding_agency', $userAgency)
            ->where('status', 'closed')
            ->count();

        return view('agency.analysis', compact('inProgressCount', 'resolvedCount', 'closedCount'));
    }


}
