<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncidentType;
use App\Models\Reports;
use App\Mail\ReportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class MailController extends Controller
{
    public function response($id)
    {
        $report = Reports::find($id);

        if (!$report) {
            return redirect()->route('admin.pending')->with('error', 'Report not found.');
        }

        $incidentType = IncidentType::where('name', $report->subject_type)->first();

        if (!$incidentType) {
            return redirect()->route('admin.pending')->with('error', 'Incident type not found.');
        }

        $email = $incidentType->email;

        if (!$email) {
            return redirect()->route('admin.pending')->with('error', 'Email address not found for this incident type.');
        }

        $report->status = 'in-progress';
        $report->save();

        try {
            Mail::to($email)->send(new ReportMail($report));

            return redirect()->route('admin.pending')->with('sent_success', 'Message sent successfully!');
        } catch (Exception $e) {
            \Log::error('Mail sending failed: ' . $e->getMessage());

            return redirect()->route('admin.pending')->with('error', 'Failed to send the message. Please check your internet connection or try again later.');
        }
    }
}
