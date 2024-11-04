<?php

namespace App\Http\Controllers;


use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('users.user-home', compact('allReports', 'pending', 'resolved', 'closed'));
    }



    public function adminHome()
    {
        $adminreport = Reports::whereIn('status', ['pending', 'solved'])->count();
        $pendingreport = Reports::where('status', 'pending')->count();
        $solvedreport = Reports::where('status', 'solved')->count();

        $reports = Reports::whereIn('status', ['pending', 'solved'])->paginate(10);
        $resolved = Reports::where('status', 'solved')->paginate(10);
        $pending = Reports::where('status', 'pending')->paginate(10);

        $recent = Reports::where('status', 'pending')->latest()->take(5)->get();
        return view('admin.adminhome', compact(
            'adminreport',
            'pendingreport',
            'solvedreport',
            'reports',
            'resolved',
            'pending',
            'recent'
        ));
    }

    public function admin_2()
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
            'admin-2.index',
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
