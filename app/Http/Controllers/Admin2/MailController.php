<?php

namespace App\Http\Controllers\Admin2;

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
            return redirect()->route('admin-2.pending')->with('error', 'Report not found.');
        }

        $incidentType = IncidentType::where('name', $report->subject_type)->first();

        if (!$incidentType) {
            return redirect()->route('admin-2.pending')->with('error', 'Incident type not found.');
        }

        $email = $incidentType->email;

        if (!$email) {
            return redirect()->route('admin-2.pending')->with('error', 'Email address not found for this incident type.');
        }

        try {
            Mail::to($email)->send(new ReportMail($report));

            return redirect()->route('admin-2.pending')->with('success', 'Message sent successfully!');
        } catch (Exception $e) {
            // Log the exception for debugging purposes
            \Log::error('Mail sending failed: ' . $e->getMessage());

            // Handle the offline or failure response
            return redirect()->route('admin-2.pending')->with('error', 'Failed to send the message. Please check your internet connection or try again later.');
        }
    }
}
