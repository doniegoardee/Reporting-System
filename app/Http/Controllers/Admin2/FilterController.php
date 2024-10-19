<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\IncidentType;
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

        $allReports = $query->paginate(5);

        return view('admin-2.reports.all-reports', compact('allReports', 'incidentTypes', 'barangay'));
    }



    public function filter_pending(Request $request)
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

        $pending = $query->where('status', 'pending')->paginate(5, ['*'], 'pending');

        return view('admin-2.reports.pending', compact('pending', 'incident', 'barangay'));
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
            $query->where('location', $barangay);
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

        $resolved = $query->where('status', 'resolved')->paginate(5, ['*'], 'resolved');

        return view('admin-2.reports.resolved', compact('resolved', 'incident', 'barangay'));
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
                $request->input('start_date'),
                $request->input('end_date')
            ]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        $closed = $query->where('status', 'closed')->paginate(5, ['*'], 'closed');

        return view('admin-2.reports.closed', compact('closed', 'incident', 'barangay'));
    }
}
