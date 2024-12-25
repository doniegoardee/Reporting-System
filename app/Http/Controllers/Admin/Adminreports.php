<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\IncidentType;
use App\Models\ArchiveIncident;
use App\Models\Reports;
use Illuminate\Http\Request;

class Adminreports extends Controller
{

    public function all_reports()
    {
        $incidentTypes = IncidentType::all();
        $barangay = Barangay::All();

        $allReports = Reports::orderBy('created_at', 'desc')->paginate(5);

        return view('admin.reports.all-reports', compact('allReports', 'incidentTypes', 'barangay'));
    }


    public function pending()
    {

        $incident = IncidentType::all();
        $archive = ArchiveIncident::all();
        $barangay = Barangay::all();

        $pending = Reports::whereIn('status', ['pending', 'in-progress'])
        ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->appends(request()->all());


        return view('admin.reports.pending', compact('pending', 'incident','archive', 'barangay'));
    }



    public function resolved()
    {

        $incident = IncidentType::all();
        $barangay = Barangay::all();

        $resolved = Reports::where('status', 'resolved')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.reports.resolved', compact('resolved', 'incident', 'barangay'));
    }



    public function closed()
    {

        $incident = IncidentType::all();
        $barangay = Barangay::all();

        $closed = Reports::where('status', 'closed')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.reports.closed', compact('closed', 'incident', 'barangay'));
    }
}
