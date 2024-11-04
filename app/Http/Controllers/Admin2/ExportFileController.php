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

        $data = ['reports' => $reports];

        $pdf = Pdf::loadView('admin-2.pdf.mypdf', $data)->setPaper('a4', 'portrait');

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
