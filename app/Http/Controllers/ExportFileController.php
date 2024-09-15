<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDataExport;
use App\Exports\ResolvedReportExport;
use App\Models\Reports;
use Illuminate\Http\Request;
use PDF;

class ExportFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function generatePDF()
    {
        $reports = Reports::where('status', 'solved')->get();

        // Convert the collection to an array and pass it as part of the data array
        $data = ['reports' => $reports->toArray()];

        // Load the view and pass the data array to it
        $pdf = PDF::loadView('admin.reports.mypdf', $data)->setPaper('a4', 'portrait');

        // Return the generated PDF for download
        return $pdf->download('reports.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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