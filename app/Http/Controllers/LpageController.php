<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\IncidentType;
use App\Models\Reports;
use Illuminate\Http\Request;


class LpageController extends Controller
{


    public function index()
    {
        $report = Reports::all();
        $incident = IncidentType::all();
        $barangay = Barangay::all();
        return view('welcome', compact('report', 'incident', 'barangay'));
    }
}
