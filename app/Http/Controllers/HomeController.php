<?php

namespace App\Http\Controllers;


use App\Models\Reports;
use App\Models\User;
use App\Models\IncidentType;
use App\Models\Seminars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {



        $incident = IncidentType::latest()
            ->take(3)
            ->get();

        $seminars = Seminars::latest()
            ->take(3)
            ->get();






        $user = Auth::user();
        $userid = $user->id;

        $allReports = Reports::where('user_id', $userid)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $pending = Reports::where('user_id', $userid)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $resolved = Reports::where('user_id', $userid)
            ->where('status', 'resolved')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $closed = Reports::where('user_id', $userid)
            ->where('status', 'closed')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('users.user-home', compact('allReports', 'pending', 'resolved', 'incident', 'seminars', 'closed'));
    }



    public function agency()
    {

        $user = Auth::user();

        $userAgency = $user->agency;

        $reports = Reports::where('responding_agency', $userAgency)
        ->where('status', 'in-progress')
        ->paginate(10);

        \Log::info(Reports::where('responding_agency', $userAgency)
    ->where('status', 'in-progress')
    ->toSql());




        return view('agency.index', compact('reports', 'userAgency'));
    }





    public function admin()
    {

        $allReportsCount = Reports::count();
        $pendingCount = Reports::where('status', 'pending')->count();
        $resolvedCount = Reports::where('status', 'resolved')->count();
        $closedCount = Reports::where('status', 'closed')->count();

        $allReports = Reports::orderBy('created_at', 'desc')
            ->paginate(5);


        $pending = Reports::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        $resolved = Reports::where('status', 'resolved')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $closed = Reports::where('status', 'closed')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        $recent = Reports::orderBy('created_at', 'desc')->paginate(5);


        return view(
            'admin.index',
            compact(
                'allReports',
                'pending',
                'resolved',
                'closed',
                'recent',
                'allReportsCount',
                'pendingCount',
                'resolvedCount',
                'closedCount'
            )
        );
    }

    public function home()
    {
        return view('welcome', ["message" => "home"]);
    }
}
