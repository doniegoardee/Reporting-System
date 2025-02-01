<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\IncidentType;
use App\Models\ArchiveIncident;
use App\Models\Reports;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filtering(Request $request)
    {
        $incidentTypes = IncidentType::all();
        $barangay = Barangay::all();

        $query = Reports::query();

        if ($request->filled('report')) {
            $incidentTypeName = IncidentType::find($request->input('report'))->name;
            $query->where('subject_type', $incidentTypeName);
        }

        if ($request->filled('location')) {
            $barangayname = Barangay::find($request->input('location'))->barangay;
            $query->where('location', $barangayname);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->input('start_date'),
                $request->input('end_date')
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        $allReports = $query->paginate(5)->appends($request->all());

        return view('admin.reports.all-reports', compact('allReports', 'incidentTypes', 'barangay'));
    }

    public function filter_pending(Request $request)
    {
        $incident = IncidentType::all();
        $barangay = Barangay::all();
        $archive = ArchiveIncident::all();

        $query = Reports::query();

        if ($request->filled('issue')) {
            $incidentname = IncidentType::find($request->input('issue'))->name;
            $query->where('subject_type', $incidentname);
        }

        if ($request->filled('location')) {
            $barangayname = Barangay::find($request->input('location'))->barangay;
            $query->where('location', $barangayname);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->input('start_date'),
                $request->input('end_date')
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        $pending = $query->whereIn('status', ['pending', 'in-progress'])
        ->paginate(5, ['*'], 'pending')
        ->appends($request->all());

        return view('admin.reports.pending', compact('pending', 'incident', 'archive', 'barangay'));
    }

    public function filter_resolved(Request $request)
{
    $incident = IncidentType::all();
    $barangay = Barangay::all();

    $query = Reports::query();

    if ($request->filled('issue')) {
        $incidentname = IncidentType::find($request->input('issue'))->name;
        $query->where('subject_type', $incidentname);
    }

    if ($request->filled('location')) {
        $barangayname = Barangay::find($request->input('location'))->barangay;
        $query->where('location', $barangayname);
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->input('start_date'),
            $request->input('end_date')
        ]);
    } elseif ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->input('start_date'));
    } elseif ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->input('end_date'));
    }

    $resolved = $query->where('status', 'resolved')->paginate(5, ['*'], 'resolved')->appends($request->all());

    return view('admin.reports.resolved', compact('resolved', 'incident', 'barangay'));
}


public function filter_closed(Request $request)
{
    $incident = IncidentType::all();
    $barangay = Barangay::all();

    $query = Reports::query();

    if ($request->filled('issue')) {
        $incidentname = IncidentType::find($request->input('issue'))->name;
        $query->where('subject_type', $incidentname);
    }

    if ($request->filled('location')) {
        $barangayname = Barangay::find($request->input('location'))->barangay;
        $query->where('location', $barangayname);
    }

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            Carbon::parse($request->input('start_date'))->startOfDay(),
            Carbon::parse($request->input('end_date'))->endOfDay()
        ]);
    } elseif ($request->filled('start_date')) {

        $query->whereDate('created_at', '>=', Carbon::parse($request->input('start_date'))->startOfDay());

    } elseif ($request->filled('end_date')) {

        $query->whereDate('created_at', '<=', Carbon::parse($request->input('end_date'))->endOfDay());
    }

    $closed = $query->where('status', 'closed')
        ->paginate(5)
        ->appends($request->all());

    return view('admin.reports.closed', compact('closed', 'incident', 'barangay'));
}

}
