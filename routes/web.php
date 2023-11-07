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
Route::get('/user/confirmregister', function () {
    return view('user.confirm');
});

// Route::get('/user/listing', function () {
//     return view('user.listing');
// });


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

// Route::get('/leads', function () {
//     return view('leads');
// });

use App\Http\Controllers\RfxController;
// Route::get('/RFx', function () {
//     return view('RFx');
// });
Route::get('/RFx/new', function () {
    return view('newRFx');
});
Route::post('/RFx/new', [RfxController::class, 'store'])->name('rfx.store');
Route::get('/RFx', [RfxController::class, 'index'])->name('rfx.index');
Route::get('/RFx/search', [RfxController::class, 'search'])->name('rfx.search');
Route::patch('/RFx/{id}/updateStatus',[RfxController::class,'updateStatus'])->name('rfx.updateStatus');
Route::delete('/RFx/delete/{id}', [RFxController::class, 'delete'])->name('rfx.delete');



Route::get('/leads/confirmregister', function () {
    return view('user.confirm');
});


use App\Http\Controllers\CustomerController;/*
Route::get('/customer/register', [CustomerController::class, 'create'])->name('customer.register.create');
Route::post('/customer/register', [CustomerController::class, 'store'])->name('customer.register.store');
Route::get('/customer/listing', [CustomerController::class, 'index'])->name('customer.listing');
Route::get('customer/search', [CustomerController::class, 'search'])->name('customer.search');
Route::delete('/customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
*/

Route::get('/customer/register', function () {
    return view('customer.register');
});

Route::get('/customer/listing', function () {
    return view('customer.listing');
});

Route::get('/customer/confirm', function () {
    return view('customer.confirm');
});

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


Route::get('/customer/listing', CustomerController::class.'@index')->name('customer.listing');
