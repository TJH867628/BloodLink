<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('User.Main');
});
Route::get('register',[UserController::class, 'registerPage']) -> name('register');
Route::post('register',[UserController::class, 'submitRegister']) -> name('register');
Route::get('login',[UserController::class, 'loginPage']) -> name('login');
Route::post('login',[UserController::class, 'authLogin']) -> name('auth.login');
Route::get('donor/dashboard', [App\Http\Controllers\DonorController::class, 'donorDashboard'])->name('donor.dashboard');
Route::get('donor/findEvent', [App\Http\Controllers\DonorController::class, 'findEvent'])->name('donor.findEvent');
Route::get('donor/history', [App\Http\Controllers\DonorController::class, 'history'])->name('donor.history');
Route::get('donor/feedback', [App\Http\Controllers\DonorController::class, 'feedback'])->name('donor.feedback');
Route::get('donor/profile', [App\Http\Controllers\DonorController::class, 'profile'])->name('donor.profile');
Route::get('hospital/dashboard', [App\Http\Controllers\HospitalController::class, 'hospitalDashboard'])->name('hospital.dashboard');
Route::get('hospital/inventory', [App\Http\Controllers\HospitalController::class, 'inventory_and_report'])->name('hospital.inventory');
Route::get('hospital/donationManagement', [App\Http\Controllers\HospitalController::class, 'donationManagement'])->name('hospital.donationManagement');