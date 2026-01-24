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
    Route::get('donor/notification', [DonorController::class, 'notification'])->name('donor.notification');

    Route::post('donor/bookEvent/{eventId}', [DonorController::class, 'bookEvent'])->name('donor.bookEvent');
    Route::post('donor/notification', [DonorController::class, 'updateProfile'])->name('donor.updateProfile');
    Route::post('donor/submitFeedback', [DonorController::class, 'submitFeedback'])->name('donor.submitFeedback');
    Route::post('donor/cancelAppointment/{appointmentId}', [DonorController::class, 'cancelAppointment'])->name('donor.cancelAppointment');
    Route::post('donor/markNotificationRead/{notificationId}', [DonorController::class, 'markNotificationAsRead'])->name('donor.markNotificationRead');
    Route::post('donot/markAllNotificationsRead', [DonorController::class, 'markAllNotificationsAsRead'])->name('donor.markAllNotificationsRead');
});
Route::middleware(['role:STAFF','auth'])->group(function () {
    Route::get('medical_facilities/dashboard', [MedicalFacilitiesController::class, 'medicalFacilitiesDashboard'])->name('medical_facilities.dashboard');
    Route::get('medical_facilities/inventory', [MedicalFacilitiesController::class, 'inventory_and_report'])->name('medical_facilities.inventory');
    Route::get('medical_facilities/donationManagement', [MedicalFacilitiesController::class, 'donationManagement'])->name('medical_facilities.donationManagement');
    Route::get('medical_facilities/bloodtypeManagement', [MedicalFacilitiesController::class, 'bloodtypeManagement'])->name('medical_facilities.bloodtypeManagement');
    Route::get('medical_facilities/profile', [MedicalFacilitiesController::class, 'profile'])->name('medical_facilities.profile');
    Route::post('medical_facilities/notification', [MedicalFacilitiesController::class, 'notification'])->name('medical_facilities.notification');

    Route::post('medical_facilities/recordDonationResult/{appointment_id}', [MedicalFacilitiesController::class, 'recordDonationResult'])->name('medical_facilities.recordDonationResult');
});
Route::middleware(['role:ORGANIZER','auth'])->group(function () {
    Route::get('event_organizer/dashboard', [EventOrganizerController::class, 'eventOrganizerDashboard'])->name('event_organizer.dashboard');
    Route::get('event_organizer/eventManagement', [EventOrganizerController::class, 'eventManagement'])->name('event_organizer.eventManagement');
    Route::get('event_organizer/participation', [EventOrganizerController::class, 'participation'])->name('event_organizer.participation');
    Route::get('event_organizer/profile', [EventOrganizerController::class, 'profile'])->name('event_organizer.profile');
    Route::get('event_organizer/notification', [EventOrganizerController::class, 'notification'])->name('event_organizer.notification');

    Route::post('event_organizer/createEvent', [EventOrganizerController::class, 'createEvent'])->name('event_organizer.createEvent'); 
    Route::post('event_organizer/editEvent/{id}', [EventOrganizerController::class, 'editEvent'])->name('event_organizer.editEvent');
    Route::post('event_organizer/deleteEvent/{id}', [EventOrganizerController::class, 'deleteEvent'])->name('event_organizer.deleteEvent');
    Route::post('event_organizer/acceptAppointment/{id}', [EventOrganizerController::class, 'acceptAppointment'])->name('event_organizer.acceptAppointment');
    Route::post('event_organizer/rejectAppointment/{id}', [EventOrganizerController::class, 'rejectAppointment'])->name('event_organizer.rejectAppointment');
});
Route::middleware(['role:ADMIN','auth'])->group(function () {
    Route::get('admin/dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/userManagement', [App\Http\Controllers\AdminController::class, 'userManagement'])->name('admin.userManagement');
    Route::get('admin/medicalFacilitiesManagement', [App\Http\Controllers\AdminController::class, 'medicalFacilitiesManagement'])->name('admin.medicalFacilitiesManagement');
    Route::get('admin/systemModification', [App\Http\Controllers\AdminController::class, 'systemModification'])->name('admin.systemModification');
    Route::get('admin/auditReport', [App\Http\Controllers\AdminController::class, 'auditReport'])->name('admin.auditReport');

    Route::post('admin/toggleUserActivation/{userId}', [App\Http\Controllers\AdminController::class, 'toggleUserActivation'])->name('admin.toggleUserActivation');
    Route::post('admin/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser');
    Route::post('admin/editUser/{userId}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('admin/createMedicalFacility', [App\Http\Controllers\AdminController::class, 'createMedicalFacility'])->name('admin.createMedicalFacility');
    Route::post('admin/editMedicalFacility/{facilityId}', [App\Http\Controllers\AdminController::class, 'editMedicalFacility'])->name('admin.editMedicalFacility');
    Route::post('admin/updateSystemSettings', [App\Http\Controllers\AdminController::class, 'updateSystemSettings'])->name('admin.updateSystemSettings');
});