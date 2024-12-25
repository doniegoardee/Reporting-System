<?php

use App\Mail\ReportMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LpageController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\Status;
use App\Http\Controllers\Admin\Analysis;
use App\Http\Controllers\Admin\Settings;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SeminarController;
use App\Http\Controllers\Admin\Adminreports;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\ExportFileController;
use App\Http\Controllers\Admin\BarangayAndIncident;

use App\Http\Controllers\Agency\ReportController;
use App\Http\Controllers\Agency\Profile;

use App\Http\Controllers\Users\ChatBotController;
use App\Http\Controllers\Users\Setting;
use App\Http\Controllers\Users\Notification;
use App\Http\Controllers\Users\ControllerReports;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", [LpageController::class, 'index'])->name('Lpage');
Route::post('/store', [LpageController::class, 'store'])->name('store');


Route::get("/home", [HomeController::class, 'home'])->name('h');

Auth::routes();

// Route::get('/mail', function () {
//     Mail::to('smokefacebook02@gmail.com')->send(new ReportMail(''));
// });

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
        });


        Route::prefix('settings')->group(function () {
            Route::get('/setting', [Setting::class, 'user_settings'])->name('user.settings');
            Route::put('/profile', [Setting::class, 'update'])->name('user.profile-update');
            Route::post('/change-password', [Setting::class, 'updatePassword'])->name('user.change');
            Route::delete('/delete-account', [Setting::class, 'deleteAccount'])->name('user.delete');
        });

        Route::post('/botman', [ChatBotController::class, 'handleBot']);

        Route::post('/notifications/{id}/read', [Notification::class, 'markNotificationAsRead']);

        Route::get('/profile', [UsersController::class, 'profile'])->name('user.profile');

    });
});


// admin routes
Route::middleware(['auth', 'user-role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [HomeController::class, 'admin'])->name('index');


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



    Route::prefix('/seminar')->group(function () {
        Route::get('/', [SeminarController::class, 'index'])->name('seminar');
        Route::get('/add', [SeminarController::class, 'add_seminar'])->name('add-seminar');
        Route::post('/store', [SeminarController::class, 'store'])->name('seminar-store');
    });

    Route::prefix('add/incident')->group(function () {
        Route::get('/', [BarangayAndIncident::class, 'incident'])->name('incident');
        Route::post('/store', [BarangayAndIncident::class, 'add_incident'])->name('store');
        Route::get('/barangay', [BarangayAndIncident::class, 'barangay'])->name('barangay');
        Route::post('/store/barangay', [BarangayAndIncident::class, 'add_barangay'])->name('add_barangay');
    });



    Route::prefix('del')->group(function () {
        Route::get('/barangays', [BarangayAndIncident::class, 'bar'])->name('bar');
        Route::delete('/barangays/{id}', [BarangayAndIncident::class, 'archive_bar'])->name('del-bar');
        Route::delete('/unbarangays/{id}', [BarangayAndIncident::class, 'unarchive_bar'])->name('un-bar');
        Route::get('/incident', [BarangayAndIncident::class, 'inc'])->name('inc');
        Route::delete('/Incident/{id}', [BarangayAndIncident::class, 'archive_inc'])->name('del-inc');
        Route::delete('/unIncident/{id}', [BarangayAndIncident::class, 'unarchive_inc'])->name('un-inc');
    });


    Route::get('/activity-log', [UsersController::class, 'activitylog'])->name('activity-log');
    Route::get('/pdf', [ExportFileController::class, 'generatePDF'])->name('export.pdf');
    Route::get('/analysis', [Analysis::class, 'analysis'])->name('analysis');



    Route::prefix('settings')->group(function () {
        Route::get('/setting', [Settings::class, 'settings'])->name('settings');
        Route::put('/profile', [Settings::class, 'update'])->name('profile-update');
        Route::post('/change-password', [Settings::class, 'updatePassword'])->name('change');
        Route::delete('/delete-account', [Settings::class, 'deleteAccount'])->name('delete');
    });

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markNotificationAsRead'])
    ->name('notif');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])
    ->name('notifications.unread-count');

    Route::put('/update/{id}/{status}', [Status::class, 'updateStatus'])->name('update');

    Route::get('/profile', [UsersController::class, 'show'])->name('profile.show');

    Route::get('/send-email/{id}', [MailController::class, 'response'])->name('send.email');


});



// agency routes
Route::middleware(['auth', 'user-role:agency'])->group(function () {
    Route::get("/agency/home", [HomeController::class, 'agency'])->name('agency.home');
    Route::get("/agency/record", [ReportController::class, 'agency_record'])->name('agency.records');
    Route::put('/update/{id}/{status}', [ReportController::class, 'markasresolved'])->name('mark');
    Route::get('agency/setting', [Profile::class, 'agency_profile'])->name('agency.settings');
    Route::put('agency/profile', [Profile::class, 'update'])->name('agency.profile-update');
    Route::post('agency/change-password', [Profile::class, 'updatePassword'])->name('agency.change');
});
