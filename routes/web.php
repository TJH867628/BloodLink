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
Route::get('logout',[UserController::class, 'logout']) -> name('logout');
Route::middleware(['role:DONOR','auth'])->group(function () {
    Route::get('donor/dashboard', [App\Http\Controllers\DonorController::class, 'donorDashboard'])->name('donor.dashboard');
    Route::get('donor/findEvent', [App\Http\Controllers\DonorController::class, 'findEvent'])->name('donor.findEvent');
    Route::get('donor/history', [App\Http\Controllers\DonorController::class, 'history'])->name('donor.history');
    Route::get('donor/feedback', [App\Http\Controllers\DonorController::class, 'feedback'])->name('donor.feedback');
    Route::post('donor/bookEvent/{eventId}', [App\Http\Controllers\DonorController::class, 'bookEvent'])->name('donor.bookEvent');
    Route::post('donor/submitFeedback', [App\Http\Controllers\DonorController::class, 'submitFeedback'])->name('donor.submitFeedback');
});