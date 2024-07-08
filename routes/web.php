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
Auth::routes();



//provider
Route::get('/',[\App\Http\Controllers\ProviderController\ProviderLoginController::class,'index']);
Route::post('/login_provider',[\App\Http\Controllers\ProviderController\ProviderLoginController::class,'login'])->name('provider_login');
Route::get('/provider/logout',[\App\Http\Controllers\ProviderController\ProviderLoginController::class,'logout'])->name('provider_logout');

Route::post('/provider/dashboard/store',[\App\Http\Controllers\ProviderController\VehicleParkedController::class,'store'])->name('provider_store');
Route::post('/provider/dashboard/user_data',[\App\Http\Controllers\ProviderController\VehicleParkedController::class,'user_parked_data']);


//admin
Route::get('/admin/login',[\App\Http\Controllers\AdminController\AdminLoginController::class,'index']);
Route::post('/admin/dashboard',[\App\Http\Controllers\AdminController\AdminLoginController::class,'login'])->name('admin_login');
Route::get('/admin/logout',[\App\Http\Controllers\AdminController\AdminLoginController::class,'logout'])->name('admin_logout');

Route::get('/admin/dashboard/provider',[\App\Http\Controllers\AdminController\AdminProvider::class,'index'])->name('admin_dashboard_provider');
Route::post('/admin/dashboard/provider/store',[\App\Http\Controllers\AdminController\AdminProvider::class,'store']);
Route::post('/admin/dashboard/provider/update',[\App\Http\Controllers\AdminController\AdminProvider::class,'update']);

Route::get('/admin/dashboard/vehicle',[\App\Http\Controllers\AdminController\VehicleController::class,'index'])->name('admin_dashboard_vehicle');
Route::post('/admin/dashboard/vehicle/store',[\App\Http\Controllers\AdminController\VehicleController::class,'store']);
Route::post('/admin/dashboard/vehicle/update',[\App\Http\Controllers\AdminController\VehicleController::class,'update']);
Route::post('/admin/dashboard/vehicle/destroy',[\App\Http\Controllers\AdminController\VehicleController::class,'destroy']);
