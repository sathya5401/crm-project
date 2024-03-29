<?php

use Illuminate\Support\Facades\Route;

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


//Test routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('layouts.app');
});
Route::get('/side', function () {
    return view('layouts.sidebar');
});

//Real routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\PasswordController;
Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change')->middleware('auth');
Route::post('/password/change', [PasswordController::class, 'change'])->name('password.change.post');


use App\Http\Controllers\UserController;
Route::get('/user/register', [UserController::class, 'create'])->name('user.register.create');
Route::post('/user/register', [UserController::class, 'store'])->name('user.register.store');
Route::get('/user/listing', [UserController::class, 'index'])->name('user.listing');
Route::get('user/search', [UserController::class, 'search'])->name('user.search');
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/details/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/permission/{id}', [UserController::class, 'permission'])->name('user.permission');
Route::post('/user/updatePermission/{id}',[UserController::class, 'updatePermission'])->name('user.updatePermission');
Route::get('/user/confirmregister', function () {
    return view('user.confirm');
});


use App\Http\Controllers\LeadController;
Route::get('/leads/new', [LeadController::class, 'new'])->name('leads.new');
Route::post('/leads/new', [LeadController::class, 'store'])->name('leads.store');
Route::get('/leads', [LeadController::class, 'index'])->name('leads');
Route::get('/leads/search', [LeadController::class, 'search'])->name('leads.search');
Route::delete('/leads/delete/{id}', [LeadController::class, 'delete'])->name('leads.delete');
Route::get('/leads/edit/{id}', [LeadController::class, 'edit'])->name('leads.edit');
Route::put('/leads/update/{id}', [LeadController::class, 'update'])->name('lead.update');
Route::get('/leads/{id}', [LeadController::class, 'show'])->name('leads.show');
// Route::get('/leads', function () {
//     return view('leads');
// });

use App\Http\Controllers\RfxController;
// Route::get('/RFx', function () {
//     return view('RFx');
// });
Route::get('/RFx/new', [RfxController::class, 'new'])->name('rfx.new');
Route::post('/RFx/new', [RfxController::class, 'store'])->name('rfx.store');
Route::get('/RFx', [RfxController::class, 'index'])->name('rfx.index');
Route::get('/RFx/search', [RfxController::class, 'search'])->name('rfx.search');
Route::patch('/RFx/{id}/updateStatus',[RfxController::class,'updateStatus'])->name('rfx.updateStatus');
Route::delete('/RFx/delete/{id}', [RfxController::class, 'delete'])->name('rfx.delete');
Route::get('/RFx/edit/{id}', [RfxController::class, 'edit'])->name('rfx.edit');
Route::put('/RFx/update/{id}', [RfxController::class, 'update'])->name('rfx.update');
Route::get('/RFx/{id}', [RfxController::class, 'show'])->name('rfx.show');



Route::get('/leads/confirmregister', function () {
    return view('user.confirm');
});

use App\Http\Controllers\TaskController;
// Route::get('/tasks', function () {
//     return view('tasks');
// });
Route::get('/tasks/new', [TaskController::class, 'new'])->name('tasks.new');
Route::post('/tasks/new', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::patch('/tasks/{id}/updateStatus',[TaskController::class,'updateStatus'])->name('tasks.updateStatus');
Route::patch('/tasks/{id}/updatePriority',[TaskController::class,'updatePriority'])->name('tasks.updatePriority');
Route::delete('/tasks/delete/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::post('/comments/store', [TaskController::class, 'storeComment'])->name('comments.store');
// Route::get('/tasks/assign/{id}', [TaskController::class, 'assigntask'])->name('tasks.assignTask');
// Route::post('/tasks/assign/{id}', [TaskController::class, 'assign'])->name('tasks.assign');


use App\Http\Controllers\AnalyticsController;

Route::get('/analysis', [AnalyticsController::class, 'index'])->name('analysis');
Route::get('/download-rawdata', [AnalyticsController::class, 'downloadDataZip'])->name('download');
Route::get('/leads-analysis', [AnalyticsController::class, 'insertDataToLeads'])->name('integrate.leads');
Route::get('/rfx-analysis', [AnalyticsController::class, 'insertDataToRfx'])->name('integrate.rfx');

use App\Http\Controllers\GoogleSpreadsheetController;
Route::get('/insert-data-to-sheet', [GoogleSpreadsheetController::class, 'insertDataToSheet']);


use App\Http\Controllers\CustomersController;

Route:: resource ('customers', CustomersController::class);
Route::get ('/customers', [CustomersController::class, 'index']) ->name('customers.index');
Route::get ('/customers/create', [CustomersController::class, 'create']) ->name('customers.create');
Route::post('/customers/store', [CustomersController::class, 'store'])->name('customers.store');
// Display edit form
Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
// Handle update
Route::put('/customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');
Route::get('/customers/data', [CustomersController::class, 'show'])->name('customers.data');
//Route::get('/customers/search', 'CustomersController@search')->name('customers.search');


use App\Http\Controllers\ClientInquiryController;
use App\Http\Controllers\SupportInquiryController;

Route::get('/inquiry', [ClientInquiryController::class, 'index']);
Route::get('/inquiry/new', [ClientInquiryController::class, 'create']);
Route::post('/inquiry/new', [ClientInquiryController::class, 'store']);
Route::get('/inquiry/{id}', [ClientInquiryController::class, 'show'])->name('inquiry.show');
Route::put('/inquiry/{id}/updateStatus',[ClientInquiryController::class,'updateStatus'])->name('inquiry.updateStatus');
Route::post('/remarks/store/{id}', [ClientInquiryController::class, 'storeRemarks'])->name('remarks.store');
Route::get('/inquirydata', [ClientInquiryController::class, 'inquiryData'])->name('inquiry.data');
// Route::delete('/inquiry/listing/{inquiry}', [ClientInquiryController::class, 'destroy'])->name('inquiry.destroy');
Route::get('/support/inquiries', [SupportInquiryController::class, 'index']);
Route::get('/inquiries', [SupportInquiryController::class, 'index'])->name('inquiry.index');



use App\Http\Controllers\MarketingController;

Route::get('/marketing/home', function () {
    return view('marketing.home');
});
Route::get ('/marketing/deals', [MarketingController::class, 'deals']) ->name('deals');
Route::get ('/marketing/meeting', [MarketingController::class, 'meeting']) ->name('meeting');
Route::get ('/marketing/meeting/new', [MarketingController::class, 'createMeeting']) ->name('createMeeting');
Route::post('/marketing/meeting/new', [MarketingController::class, 'store'])->name('meeting.store');
Route::delete('/marketing/meeting/{meeting}', [MarketingController::class, 'destroy'])->name('meeting.destroy');
// Route::get('/meeting/sentmail', [MeetingController::class, 'show'])->name('meeting.show');
Route::get('/marketing/sentmail', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();

        // Check if the user has permission to edit customers data
        if ($user->can_send_email) {
            // User has permission, return the view
            return view('marketing.sentmail');
        } else {
            // User does not have permission, return a permission error view
            return view('errors.permission')->with('message', 'You do not have permission send email.');
        }
    }

    // If the user is not authenticated, you might want to redirect to the login page
    return redirect('/login');
})->middleware('auth'); // Apply the 'auth' middleware to ensure the user is authenticated


use App\Http\Controllers\MailController;
Route::get('/marketing/email', function () {return view('marketing.email');});
Route::post('/send',[MailController::class,'send'])->name('send.email');




