<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportDataExport implements ShouldAutoSize, FromCollection
{
    use Exportable;

    // private $users;

    public function collection()
    {
        return User::all();
    }


    // public function __construct()
    // {
    //     $this->users = User::all();
    // }

    // public function view(): View
    // {
    //     return view('user-barangay.user-table', [
    //         'users' => $this->users
    //     ]);
    // }



    // /**

    // public function collection()
    // {
    //     //
    // }
}