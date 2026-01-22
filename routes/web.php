<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\EventOrganizerController;

Route::get('/', function () {
    return view('User.Main');
});
Route::get('register',[UserController::class, 'registerPage']) -> name('register');
Route::post('register',[UserController::class, 'submitRegister']) -> name('register');
Route::get('login',[UserController::class, 'loginPage']) -> name('login');
Route::post('login',[UserController::class, 'authLogin']) -> name('auth.login');
Route::get('logout',[UserController::class, 'logout']) -> name('logout');
Route::middleware(['role:DONOR','auth'])->group(function () {
<<<<<<< Updated upstream
    Route::get('donor/dashboard', [DonorController::class, 'donorDashboard'])->name('donor.dashboard');
    Route::get('donor/findEvent', [DonorController::class, 'findEvent'])->name('donor.findEvent');
    Route::get('donor/history', [DonorController::class, 'history'])->name('donor.history');
    Route::get('donor/feedback', [DonorController::class, 'feedback'])->name('donor.feedback');
    Route::get('donor/profile', [DonorController::class, 'profile'])->name('donor.profile');

    Route::post('donor/bookEvent/{eventId}', [DonorController::class, 'bookEvent'])->name('donor.bookEvent');
    Route::post('donor/updateProfile', [DonorController::class, 'updateProfile'])->name('donor.updateProfile');
    Route::post('donor/submitFeedback', [DonorController::class, 'submitFeedback'])->name('donor.submitFeedback');
    Route::post('donor/cancelAppointment/{appointmentId}', [DonorController::class, 'cancelAppointment'])->name('donor.cancelAppointment');
});
Route::middleware(['role:STAFF','auth'])->group(function () {
    Route::get('hospital/dashboard', [HospitalController::class, 'hospitalDashboard'])->name('hospital.dashboard');
    Route::get('hospital/inventory', [HospitalController::class, 'inventory_and_report'])->name('hospital.inventory');
    Route::get('hospital/donationManagement', [HospitalController::class, 'donationManagement'])->name('hospital.donationManagement');

});
Route::middleware(['role:ORGANIZER','auth'])->group(function () {
    Route::get('event_organizer/dashboard', [EventOrganizerController::class, 'eventOrganizerDashboard'])->name('event_organizer.dashboard');
    Route::get('event_organizer/eventManagement', [EventOrganizerController::class, 'eventManagement'])->name('event_organizer.eventManagement');
    Route::get('event_organizer/participation', [EventOrganizerController::class, 'participation'])->name('event_organizer.participation');
    Route::post('event_organizer/createEvent', [EventOrganizerController::class, 'createEvent'])->name('event_organizer.createEvent'); 
    Route::post('event_organizer/editEvent/{id}', [EventOrganizerController::class, 'editEvent'])->name('event_organizer.editEvent');
    Route::post('event_organizer/deleteEvent/{id}', [EventOrganizerController::class, 'deleteEvent'])->name('event_organizer.deleteEvent');
    Route::post('event_organizer/acceptAppointment/{id}', [EventOrganizerController::class, 'acceptAppointment'])->name('event_organizer.acceptAppointment');
    Route::post('event_organizer/rejectAppointment/{id}', [EventOrganizerController::class, 'rejectAppointment'])->name('event_organizer.rejectAppointment');
=======
    Route::get('donor/dashboard', [App\Http\Controllers\DonorController::class, 'donorDashboard'])->name('donor.dashboard');
    Route::get('donor/findEvent', [App\Http\Controllers\DonorController::class, 'findEvent'])->name('donor.findEvent');
    Route::get('donor/history', [App\Http\Controllers\DonorController::class, 'history'])->name('donor.history');
    Route::get('donor/feedback', [App\Http\Controllers\DonorController::class, 'feedback'])->name('donor.feedback');
    Route::post('donor/bookEvent/{eventId}', [App\Http\Controllers\DonorController::class, 'bookEvent'])->name('donor.bookEvent');
    Route::post('donor/submitFeedback', [App\Http\Controllers\DonorController::class, 'submitFeedback'])->name('donor.submitFeedback');
>>>>>>> Stashed changes
});