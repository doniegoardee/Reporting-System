<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Reports;
use Illuminate\Http\Request;

class IncidentHistoryController extends Controller
{
    // Show incident history
    public function index(Request $request)
    {
        // Fetch the incident data and unique locations
        $history = Reports::where('privacy', 'public')->orderBy('created_at', 'desc')->get();
        $uniqueLocations = Reports::where('privacy', 'public')->distinct()->pluck('location');

        // Return the view with data
        return view('users.history', compact('history', 'uniqueLocations'));
    }

    // Search incidents based on query and location filter
    public function searchIncidentHistory(Request $request)
{
    $query = $request->input('query');
    $location = $request->input('location');

    $historyQuery = Reports::where('privacy', 'public');

    if ($request->ajax()) {
        $typeSuggestions = $historyQuery->where('subject_type', 'LIKE', "%{$query}%")->get();
        $locationSuggestions = $historyQuery->where('location', 'LIKE', "%{$query}%")->get();

        $output = '<ul class="list-group">';

        if ($typeSuggestions->isNotEmpty()) {
            foreach ($typeSuggestions as $report) {
                $output .= '<li class="list-group-item suggestion type-suggestion">' . $report->subject_type . '</li>';
            }
        }

        if ($locationSuggestions->isNotEmpty()) {
            foreach ($locationSuggestions as $report) {
                $output .= '<li class="list-group-item suggestion location-suggestion">' . $report->location . '</li>';
            }
        }

        if ($output === '<ul class="list-group"></ul>') {
            $output .= '<li class="list-group-item">No results found</li>';
        }

        $output .= '</ul>';

        return response()->json(['html' => $output]);
    }

    // Apply filters only if no AJAX request
    if ($query) {
        $historyQuery = $historyQuery->where(function ($q) use ($query) {
            $q->where('subject_type', 'LIKE', "%{$query}%")
              ->orWhere('location', 'LIKE', "%{$query}%");
        });
    }

    if ($location) {
        $historyQuery = $historyQuery->where('location', $location);
    }

    $history = $historyQuery->orderBy('created_at', 'desc')->get();

    return view('users.history', compact('history'));
}

public function view($id)
{
    $view = Reports::with('reportInfo')->findOrFail($id);
    return view('users.view-information', compact('view'));
}


}
