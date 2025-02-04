<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncidentType;
use App\Models\ReportInfo;
use App\Models\Reports;
use Illuminate\Http\Request;

class PrivacyCtrl extends Controller
{

public function index(){

$list = IncidentType::All();

return view('admin.information.privacy-information',compact('list'));

}

public function listByIncident(Request $request, $subject_type)
{
    $query = Reports::where('subject_type', $subject_type);

    if ($request->has('location') && !empty($request->location)) {
        $query->where('location', $request->location);
    }

    if ($request->has('status') && !empty($request->status)) {
        $query->where('status', $request->status);
    }

    $reports = $query->paginate(10);

    $locations = Reports::distinct()->pluck('location'); // Get unique locations for dropdown

    return view('admin.information.incident-reports', compact('reports', 'subject_type', 'locations'));
}


// View a single report
public function viewReport($id)
{
    $report = Reports::findOrFail($id);
    return view('admin.information.report-detail', compact('report'));
}

public function store(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|string',
        ]);

        ReportInfo::create([
            'report_id' => $id,
            'details' => $request->details,
        ]);

        return back()->with('success', 'Information added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'details' => 'required|string',
        ]);

        $info = ReportInfo::findOrFail($id);
        $info->update(['details' => $request->details]);

        return back()->with('success', 'Information updated successfully.');
    }



    public function destroy($id)
    {
        $info = ReportInfo::findOrFail($id);
        $info->delete();

        return back()->with('success', 'Information deleted successfully.');
    }



    public function privacy(){


        $privacy = Reports::all();

        return view('admin.privacy.reports-privacy',compact('privacy'));
    }


    public function togglePrivacy(Request $request)
{
    $report = Reports::findOrFail($request->id);
    $report->privacy = $request->privacy;
    $report->save();

    return response()->json(['success' => true, 'new_privacy' => $report->privacy]);
}

}
