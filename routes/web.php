<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ControllerReports;
use App\Http\Controllers\ExportFileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Adminreports;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/home", [HomeController::class, 'home'])->name('h');

Auth::routes();


// user routes
Route::middleware(['auth', 'user-role:user'])->group(function () {
    Route::get("/user/home", [HomeController::class, 'userHome'])->name('home.user');
    Route::get("/user/create-reports", [ControllerReports::class, 'create'])->name('user.create');
    Route::get("/user/my-reports", [ControllerReports::class, 'myreports'])->name('user.report');
    Route::post("/user/store-reports", [ControllerReports::class, 'store'])->name('user.store');

    Route::put('/reports/{id}', [ControllerReports::class, 'updateReports'])->name('reports.update');
    Route::get('/reports/{id}/edit', [ControllerReports::class, 'editReport'])->name('reports.edit');

    Route::get('/reports/{id}', [ControllerReports::class, 'show'])->name('reports.show');
});


Route::middleware(['auth', 'user-role:admin-2'])->prefix('admin-2')->name('admin-2.')->group(function () {


    Route::get('/dashboard', [HomeController::class, 'admin_2'])->name('index');

    Route::prefix('reports')->group(function () {
        Route::get('/all', [Adminreports::class, 'all_reports'])->name('all-reports');
        Route::get('/pending', [Adminreports::class, 'pending'])->name('pending');
        Route::get('/resolved', [Adminreports::class, 'resolved'])->name('resolved');
        Route::get('/closed', [Adminreports::class, 'closed'])->name('closed');
    });


    Route::prefix('users')->group(function () {
        Route::get('/list', [UsersController::class, 'user'])->name('user');
        Route::get('/add', [UsersController::class, 'add_user'])->name('add_user');
        Route::post('/add', [UsersController::class, 'register_user'])->name('adduser');
    });

    Route::prefix('filter')->group(function () {
        Route::get('/all', [Adminreports::class, 'filtering'])->name('filter');
        Route::get('/pending', [Adminreports::class, 'filter_pending'])->name('filter-pending');
        Route::get('/resolved', [Adminreports::class, 'filter_resolved'])->name('filter-resolved');
        Route::get('/closed', [Adminreports::class, 'filter_closed'])->name('filter-closed');
    });

    Route::get('/activity-log', [Adminreports::class, 'activitylog'])->name('activity-log');
    Route::get('/pdf', [ExportFileController::class, 'generatePDF'])->name('export.pdf');
    Route::get('/analysis', [Adminreports::class, 'analysis'])->name('analysis');

    Route::put('/update/{id}/{status}', [Adminreports::class, 'updateStatus'])->name('update');

    Route::prefix('profile')->group(function () {
        Route::get('/view-profile', [UsersController::class, 'profile'])->name('profile');
    });
});



// admin routes
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get("/admin/home", [HomeController::class, 'adminHome'])->name('home.admin');
    Route::get("/admin/list-users", [AdminController::class, 'userindex'])->name('admin.user');

    Route::get("/admin/activity-log", [AdminController::class, 'activitylog'])->name('admin.activity-log');

    Route::get('/admin/update-status/{id}/{status}', [ControllerReports::class, 'updateStatus'])->name('admin.update-status');

    Route::get("/admin/status", [ControllerReports::class, 'status'])->name('status');
    Route::get("/admin/manage-reports", [ControllerReports::class, 'index'])->name('admin.reports');

    Route::post("/admin/export-reports", [ExportFileController::class, 'exportExcel'])->name('export.reports');
    Route::post("/admin/export-resolved-reports", [ExportFileController::class, 'ExportReportResolved'])->name('export.resolved.reports');
    // Route::get('/pdf', [ExportFileController::class, 'generatePDF'])->name('export.pdf');
});