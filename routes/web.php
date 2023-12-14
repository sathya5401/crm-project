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


use App\Http\Controllers\UserController;
Route::get('/user/register', [UserController::class, 'create'])->name('user.register.create');
Route::post('/user/register', [UserController::class, 'store'])->name('user.register.store');
Route::get('/user/listing', [UserController::class, 'index'])->name('user.listing');
Route::get('user/search', [UserController::class, 'search'])->name('user.search');
Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/details/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/confirmregister', function () {
    return view('user.confirm');
});


use App\Http\Controllers\LeadController;
// Route::get('/leads/new', [LeadController::class, 'create'])->name('leads.create');
Route::get('/leads/new', function () {
    return view('newlead');
});

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
Route::delete('/RFx/delete/{id}', [RFxController::class, 'delete'])->name('rfx.delete');

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
Route::get('/customers/create', function () {
    return view('customers.create');
});
Route::get('/customers', function () {
    return view('customers.index');
});
Route:: resource ('customers', CustomersController::class);
Route::get ('/customers', [CustomersController::class, 'index']) ->name('customers.index');
Route::get ('/customers/create', [CustomersController::class, 'create']) ->name('customers.create');
// Display edit form
Route::get('/customers/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
// Handle update
Route::put('/customers/{customer}', [CustomersController::class, 'update'])->name('customers.update');


use App\Http\Controllers\ClientInquiryController;
use App\Http\Controllers\SupportInquiryController;

Route::get('/inquiry', [ClientInquiryController::class, 'create']);
Route::post('/inquiry', [ClientInquiryController::class, 'store']);
Route::get('/support/inquiries', [SupportInquiryController::class, 'index']);





Route::get('/marketing/home', function () {
    return view('marketing.home');
});

Route::get('/marketing/deals', function () {
    return view('marketing.deals');
});

Route::get('/marketing/meeting', function () {
    return view('marketing.meeting');
});

Route::get('/marketing/email', function () {
    return view('marketing.email');
});
