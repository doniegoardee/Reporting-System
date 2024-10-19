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
            $query->whereMonth('created_at', $month);
        } elseif ($month && $year) {
            $query->whereYear('created_at', $year)->whereMonth('created_at', $month);
        } elseif ($year) {
            $query->whereYear('created_at', $year);
        }

        $reportCountByType = $query->select(DB::raw('count(*) as count, subject_type'))
            ->groupBy('subject_type')
            ->get();

        $reportsByStatus = $query->select(DB::raw('count(*) as count, status'))
            ->groupBy('status')
            ->get();

        $reportsBySeverity = $query->select(columns: DB::raw('count(*) as count, severity'))
            ->groupBy('severity')
            ->get();

        $averageResponseTime = $query->where('status', 'resolved')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_response_time'))
            ->first();

        $selectedMonth = $month ? date('F', mktime(0, 0, 0, $month, 10)) : 'All Months'; // Convert numeric month to text
        $selectedYear = $year ? $year : 'All Years';

        return view('admin-2.analysis', compact('reportCountByType', 'reportsByStatus', 'reportsBySeverity', 'averageResponseTime', 'selectedMonth', 'selectedYear'));
    }
}
