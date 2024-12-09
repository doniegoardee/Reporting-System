<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\IncidentType;
use App\Models\Reports;
use App\Mail\ReportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function response($id)
    {
        $report = Reports::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found.'], 404);
        }

        $incidentType = IncidentType::where('name', $report->subject_type)->first();

        if (!$incidentType) {
            return response()->json(['message' => 'Incident type not found.'], 404);
        }

        $email = $incidentType->email;

        if (!$email) {
            return response()->json(['message' => 'Email address not found for this incident type.'], 400);
        }

        Mail::to($email)->send(new ReportMail($report));

        return redirect()->route('admin-2.pending')->with('success', 'message sent successfully!');
    }



}


