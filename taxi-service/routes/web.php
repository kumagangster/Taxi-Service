<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/',[\App\Http\Controllers\MapController::class,'index']);

Route::get('/courts/show/map',[\App\Http\Controllers\MapController::class,'showMap'])->name('courts.showmap');
Auth::routes();
Route::get('/map',function (){
    return view('components.map');
});
Route::get('/maps',function (){
    return view('components.map3');
});
//customer
Route::post('/calculate-distance',[\App\Http\Controllers\MapController::class,'calculateDistance']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/login',[App\Http\Controllers\CustomerAuth\LoginController::class,'showLoginForm'])->name('customer.login');
Route::get('/customer/register',[\App\Http\Controllers\CustomerAuth\RegisterController::class,'showRegistrationForm'])->name('customer.register');
Route::post('/customer/register',[\App\Http\Controllers\CustomerAuth\RegisterController::class,'create'])->name('customer.register');
Route::post('/customer/login',[\App\Http\Controllers\CustomerAuth\LoginController::class,'customerLogin']);
Route::get('/customer/home',[\App\Http\Controllers\CustomerAuth\HomeController::class,'index'])->name('customer.home');
Route::post('/customer/logout',[\App\Http\Controllers\CustomerAuth\LoginController::class,'logout'])->name('customer.logout');
Route::get('/customer/edit/{id}', [\App\Http\Controllers\Customer\CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/update/{id}',[\App\Http\Controllers\Customer\CustomerController::class,'update'])->name('customer.update');


//cutomer bookings
Route::get('/bookings',[\App\Http\Controllers\Customer\BookingController::class,'index'])->name('bookings.create');
Route::post('/bookings/store',[\App\Http\Controllers\Customer\BookingController::class,'store'])->name('bookings.store');

//Fare
Route::get('/fare',[\App\Http\Controllers\Driver\RideController::class,'index'])->name('fare');
Route::post('/fare/accept',[\App\Http\Controllers\Driver\RideController::class,''])->name('driver.accept');

//driver
Route::get('/driver/login',[App\Http\Controllers\DriverAuth\LoginController::class,'showLoginForm'])->name('driver.login');
Route::get('/driver/register',[\App\Http\Controllers\DriverAuth\RegisterController::class,'showRegistrationForm'])->name('driver.register');
Route::post('/driver/register',[\App\Http\Controllers\DriverAuth\RegisterController::class,'create'])->name('driver.register');
Route::post('/driver/login',[\App\Http\Controllers\DriverAuth\LoginController::class,'customerLogin'])->name('driver.login');
Route::get('/driver/home',[\App\Http\Controllers\DriverAuth\HomeController::class,'index'])->name('driver.home');
Route::post('/driver/logout',[\App\Http\Controllers\DriverAuth\LoginController::class,'logout'])->name('driver.logout');
Route::get('/driver/edit/{id}', [\App\Http\Controllers\Driver\DriverController::class, 'edit'])->name('driver.edit');
Route::put('/driver/update/{id}',[\App\Http\Controllers\Driver\DriverController::class,'update'])->name('driver.update');
