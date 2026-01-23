<?php

use App\Http\Controllers\MedicalFacilitiesController;
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
    Route::get('medicalFacilities/dashboard', [MedicalFacilitiesController::class, 'medicalFacilitiesDashboard'])->name('medicalFacilities.dashboard');
    Route::get('medicalFacilities/inventory', [MedicalFacilitiesController::class, 'inventory_and_report'])->name('medicalFacilities.inventory');
    Route::get('medicalFacilities/donationManagement', [MedicalFacilitiesController::class, 'donationManagement'])->name('medicalFacilities.donationManagement');

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
});
Route::middleware(['role:ADMIN','auth'])->group(function () {
    Route::get('admin/dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/userManagement', [App\Http\Controllers\AdminController::class, 'userManagement'])->name('admin.userManagement');
    Route::get('admin/hospitalManagement', [App\Http\Controllers\AdminController::class, 'hospitalManagement'])->name('admin.hospitalManagement');
    Route::get('admin/systemModification', [App\Http\Controllers\AdminController::class, 'systemModification'])->name('admin.systemModification');
    Route::get('admin/auditReport', [App\Http\Controllers\AdminController::class, 'auditReport'])->name('admin.auditReport');
});