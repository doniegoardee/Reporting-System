<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDataExport;
use App\Exports\ResolvedReportExport;
use App\Models\Reports;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class ExportFileController extends Controller
{

    public function generatePDF()
    {
        $reports = Reports::where('status', 'resolved')->get();

        // Convert the collection to an array and pass it as part of the data array
        $data = ['reports' => $reports];

        // Load the view and pass the data array to it
        $pdf = Pdf::loadView('admin-2.pdf.mypdf', $data)->setPaper('a4', 'portrait');

        // Return the generated PDF for download
        return $pdf->stream('reports.pdf');
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
