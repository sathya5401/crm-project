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


Route::get('/customer/register', function () {
    return view('customer.register');
});

Route::get('/customer/listing', function () {
    return view('customer.listing');
});

Route::get('/customer/confirmregister', function () {
    return view('customer.confirm');
});

Route::get('/marketing/home', function () {
    return view('marketing.home');
});
