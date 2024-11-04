<?php

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin2\ExportFileController;
use App\Http\Controllers\admin2\Adminreports;
use App\Http\Controllers\Admin2\Analysis;
use App\Http\Controllers\Admin2\BarangayAndIncident;
use App\Http\Controllers\Admin2\FilterController;
use App\Http\Controllers\Admin2\Settings;
use App\Http\Controllers\Admin2\Status;
use App\Http\Controllers\admin2\UsersController;

use App\Http\Controllers\Users\ControllerReports;
use App\Http\Controllers\Users\Setting;
use App\Http\Controllers\Users\ChatBotController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\Notification;
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
    Route::prefix('user')->group(function () {

        Route::get("/home", [HomeController::class, 'userHome'])->name('home.user');


        Route::prefix('reports')->group(function () {
            Route::get("/incident", [ControllerReports::class, 'incident'])->name('user.incident');
            Route::get("/create/{subject_type}", [ControllerReports::class, 'create'])->name('user.create');
            Route::post("/store", [ControllerReports::class, 'store'])->name('user.store');
            Route::get("/my", [ControllerReports::class, 'myreports'])->name('user.report');
            Route::put('/{id}', [ControllerReports::class, 'updateReports'])->name('reports.update');
            Route::get('/{id}/edit', [ControllerReports::class, 'editReport'])->name('reports.edit');
            // Route::get('/{id}', [ControllerReports::class, 'show'])->name('reports.show');
        });

        Route::post('/botman', [ChatBotController::class, 'handleBot']);

        Route::post('/notifications/{id}/read', [Notification::class, 'markNotificationAsRead']);

        Route::get('/profile', [UsersController::class, 'profile'])->name('user.profile');



        Route::prefix('settings')->group(function () {
            Route::get('/setting', [Setting::class, 'user_settings'])->name('user.settings');
            Route::put('/profile', [Setting::class, 'update'])->name('user.profile-update');
            Route::post('/change-password', [Setting::class, 'updatePassword'])->name('user.change');
            Route::delete('/delete-account', [Setting::class, 'deleteAccount'])->name('user.delete');
        });
    });
});



// admin-2 routes
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
        Route::get('/all', [FilterController::class, 'filtering'])->name('filter');
        Route::get('/pending', [FilterController::class, 'filter_pending'])->name('filter-pending');
        Route::get('/resolved', [FilterController::class, 'filter_resolved'])->name('filter-resolved');
        Route::get('/closed', [FilterController::class, 'filter_closed'])->name('filter-closed');
    });



    Route::prefix('add/incident')->group(function () {
        Route::get('/', [BarangayAndIncident::class, 'incident'])->name('incident');
        Route::post('/store', [BarangayAndIncident::class, 'add_incident'])->name('store');
        Route::get('/barangay', [BarangayAndIncident::class, 'barangay'])->name('barangay');
        Route::post('/store/barangay', [BarangayAndIncident::class, 'add_barangay'])->name('add_barangay');
    });



    Route::prefix('del')->group(function () {
        Route::get('/barangays', [BarangayAndIncident::class, 'bar'])->name('bar');
        Route::delete('/barangays/{id}', [BarangayAndIncident::class, 'del_bar'])->name('del-bar');
        Route::get('/incident', [BarangayAndIncident::class, 'inc'])->name('inc');
        Route::delete('/Incident/{id}', [BarangayAndIncident::class, 'del_inc'])->name('del-inc');
    });


    Route::get('/activity-log', [UsersController::class, 'activitylog'])->name('activity-log');
    Route::get('/pdf', [ExportFileController::class, 'generatePDF'])->name('export.pdf');
    Route::get('/analysis', [Analysis::class, 'analysis'])->name('analysis');


    Route::put('/update/{id}/{status}', [Status::class, 'updateStatus'])->name('update');


    Route::get('/profile', [UsersController::class, 'show'])->name('profile.show');





    Route::prefix('settings')->group(function () {
        Route::get('/setting', [Settings::class, 'settings'])->name('settings');
        Route::put('/profile', [Settings::class, 'update'])->name('profile-update');
        Route::post('/change-password', [Settings::class, 'updatePassword'])->name('change');
        Route::delete('/delete-account', [Settings::class, 'deleteAccount'])->name('delete');
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
