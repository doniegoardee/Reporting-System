<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\IncidentType;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDataExport;
use App\Exports\ResolvedReportExport;
use App\Models\Reports;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class ExportFileController extends Controller
{

    public function generatePDF(Request $request)
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

        $reports = $query->get();

        $data = [
            'reports' => $reports,
            'incidentTypes' => $incidentTypes,
            'barangay' => $barangay
        ];

        $pdf = Pdf::loadView('admin-2.pdf.mypdf', $data)->setPaper('a4', 'portrait');

        return $pdf->stream('filtered_reports.pdf');
    }



    public function exportExcel()
    {
        return Excel::download(new ReportDataExport, 'users-data.xlsx');
    }

    public function ExportReportResolved()
    {
        return Excel::download(new ResolvedReportExport, 'users-data.xlsx');
    }
}
