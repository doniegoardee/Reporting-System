<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use App\Models\User;
use App\Models\IncidentType;
use App\Notifications\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class Status extends Controller
{

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

                    // Send notifications
                    Notification::send($user, new Notifications('Your report has been resolved.'));
                    foreach ($admins as $admin) {
                        Notification::send($admin, new Notifications('A report has been resolved.'));
                    }

                    activity()
                        ->causedBy(auth()->user())
                        ->performedOn($data)
                        ->log('Report Resolved');
                    break;

                case 'closed':
                    if ($data->status === 'closed') {
                        return redirect()->back()->withErrors(['Report is already closed.']);
                    }
                    $data->status = 'closed';
                    $message = 'Report closed.';

                    // Send notifications
                    Notification::send($user, new Notifications('Your report has been closed.'));
                    foreach ($admins as $admin) {
                        Notification::send($admin, new Notifications('A report has been closed.'));
                    }

                    activity()
                        ->causedBy(auth()->user())
                        ->performedOn($data)
                        ->log('Report Closed');
                    break;

                default:
                    return redirect()->back()->withErrors(['Invalid action.']);
            }
            $data->save();

            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->withErrors(['Unauthorized action.']);
    }
}
