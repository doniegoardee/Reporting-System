<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use App\Models\User;
use App\Models\IncidentType; // Added to fetch dynamic agency
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

        // Fetch the dynamic agency based on the subject_type
        $incidentType = IncidentType::where('name', $data->subject_type)->first();
        $agency = $incidentType ? $incidentType->agency : 'N/A'; // Default to 'N/A' if not found

        if (Auth::check()) {
            $message = '';

            switch ($status) {
                case 'resolved':
                    if ($data->status === 'resolved') {
                        return redirect()->back()->withErrors(['Report is already resolved.']);
                    }
                    $data->status = 'resolved';
                    $data->responding_agency = $agency; // Set dynamic agency
                    $data->resolved_time = $request->input('resolved_time') ? Carbon::parse($request->input('resolved_time')) : null;
                    $message = 'Report marked as resolved successfully.';

                    // Send notifications
                    Notification::send($user, new Notifications('Your report has been resolved. Responding agency: ' . $data->responding_agency));
                    foreach ($admins as $admin) {
                        Notification::send($admin, new Notifications('A report has been resolved. Report ID: ' . $data->id));
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
                        Notification::send($admin, new Notifications('A report has been closed. Report ID: ' . $data->id));
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
