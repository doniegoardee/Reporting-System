<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analysis extends Controller
{
    public function analysis(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Reports::query();

        if ($month && !$year) {
            $query->whereMonth('reports.created_at', $month);
        } elseif ($month && $year) {
            $query->whereYear('reports.created_at', $year)
                  ->whereMonth('reports.created_at', $month);
        } elseif ($year) {
            $query->whereYear('reports.created_at', $year);
        }

        $reportCountByType = $query->select('reports.subject_type', DB::raw('count(*) as count'), 'incident_types.color')
            ->join('incident_types', 'incident_types.name', '=', 'reports.subject_type')
            ->groupBy('reports.subject_type', 'incident_types.color')
            ->get();

        $selectedMonth = $month ? date('F', mktime(0, 0, 0, $month, 10)) : 'All Months';
        $selectedYear = $year ? $year : 'All Years';

        $colorMap = $reportCountByType->pluck('color', 'subject_type')->toArray();

        return view('admin-2.analysis', compact('reportCountByType', 'selectedMonth', 'selectedYear', 'colorMap'));
    }
}
