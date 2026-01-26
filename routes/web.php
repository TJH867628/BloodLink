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
    Route::post('donor/markAllNotificationsRead', [DonorController::class, 'markAllNotificationsAsRead'])->name('donor.markAllNotificationsRead');
    Route::post('donor/changePassword', [DonorController::class, 'changePassword'])->name('donor.changePassword');
});
Route::middleware(['role:STAFF','auth'])->group(function () {
    Route::get('medical_facilities/dashboard', [MedicalFacilitiesController::class, 'medicalFacilitiesDashboard'])->name('medical_facilities.dashboard');
    Route::get('medical_facilities/inventory', [MedicalFacilitiesController::class, 'inventory_and_report'])->name('medical_facilities.inventory');
    Route::get('medical_facilities/donationManagement', [MedicalFacilitiesController::class, 'donationManagement'])->name('medical_facilities.donationManagement');
    Route::get('medical_facilities/bloodManagement', [MedicalFacilitiesController::class, 'bloodManagement'])->name('medical_facilities.bloodManagement');
    Route::get('medical_facilities/profile', [MedicalFacilitiesController::class, 'profile'])->name('medical_facilities.profile');
    Route::get('medical_facilities/exportInventory', [MedicalFacilitiesController::class, 'exportInventoryReport'])->name('medical.exportInventory');
    Route::get('medical_facilities/exportUsage', [MedicalFacilitiesController::class, 'exportUsageReport'])->name('medical.exportUsage');
    Route::get('medical_facilities/exportWastage', [MedicalFacilitiesController::class, 'exportWastageReport'])->name('medical.exportWastage');
    Route::get('medical_facilities/exportDonationRecords', [MedicalFacilitiesController::class, 'exportDonationRecords'])->name('medical.exportDonationRecords');
    Route::get('medical_facilities/notification', [MedicalFacilitiesController::class, 'notification'])->name('medical_facilities.notification');

    Route::post('medical_facilities/recordDonationResult/{appointment_id}', [MedicalFacilitiesController::class, 'recordDonationResult'])->name('medical_facilities.recordDonationResult');
    Route::post('medical_facilities/updateProfile', [MedicalFacilitiesController::class, 'updateProfile'])->name('medical_facilities.updateProfile');
    Route::post('medical_facilities/useBloodBags', [MedicalFacilitiesController::class, 'useBloodBags'])->name('medical_facilities.useBloodBags');
    Route::post('medical_facilities/updateProfile', [MedicalFacilitiesController::class, 'updateProfile'])->name('medical_facilities.updateProfile');
    Route::post('medical_facilities/changePassword', [MedicalFacilitiesController::class, 'changePassword'])->name('medical_facilities.changePassword');
    Route::post('medical_facilities/markNotificationRead/{notificationId}', [MedicalFacilitiesController::class, 'markNotificationAsRead'])->name('medical_facilities.markNotificationRead');
    Route::post('medical_facilities/markAllNotificationsRead', [MedicalFacilitiesController::class, 'markAllNotificationsAsRead'])->name('medical_facilities.markAllNotificationsRead');
});
Route::middleware(['role:ORGANIZER','auth'])->group(function () {
    Route::get('event_organizer/dashboard', [EventOrganizerController::class, 'eventOrganizerDashboard'])->name('event_organizer.dashboard');
    Route::get('event_organizer/eventManagement', [EventOrganizerController::class, 'eventManagement'])->name('event_organizer.eventManagement');
    Route::get('event_organizer/participation', [EventOrganizerController::class, 'participation'])->name('event_organizer.participation');
    Route::get('event_organizer/profile', [EventOrganizerController::class, 'profile'])->name('event_organizer.profile');
    Route::get('event_organizer/notification', [EventOrganizerController::class, 'notification'])->name('event_organizer.notification');
    Route::get('event_organizer/export-participation', [EventOrganizerController::class, 'exportParticipation'])->name('event_organizer.exportParticipation');

    Route::post('event_organizer/createEvent', [EventOrganizerController::class, 'createEvent'])->name('event_organizer.createEvent'); 
    Route::post('event_organizer/editEvent/{id}', [EventOrganizerController::class, 'editEvent'])->name('event_organizer.editEvent');
    Route::post('event_organizer/deleteEvent/{id}', [EventOrganizerController::class, 'deleteEvent'])->name('event_organizer.deleteEvent');
    Route::post('event_organizer/acceptAppointment/{id}', [EventOrganizerController::class, 'acceptAppointment'])->name('event_organizer.acceptAppointment');
    Route::post('event_organizer/rejectAppointment/{id}', [EventOrganizerController::class, 'rejectAppointment'])->name('event_organizer.rejectAppointment');
    Route::post('event_organizer/updateProfile', [EventOrganizerController::class, 'updateProfile'])->name('event_organizer.updateProfile');
    Route::post('event_organizer/markNotificationRead/{notificationId}', [EventOrganizerController::class, 'markNotificationAsRead'])->name('event_organizer.markNotificationRead');
    Route::post('event_organizer/markAllNotificationsRead', [EventOrganizerController::class, 'markAllNotificationsAsRead'])->name('event_organizer.markAllNotificationsRead');
    Route::post('event_organizer/changePassword', [EventOrganizerController::class, 'changePassword'])->name('event_organizer.changePassword');
});
Route::middleware(['role:ADMIN','auth'])->group(function () {
    Route::get('admin/dashboard', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/userManagement', [App\Http\Controllers\AdminController::class, 'userManagement'])->name('admin.userManagement');
    Route::get('admin/medicalFacilitiesManagement', [App\Http\Controllers\AdminController::class, 'medicalFacilitiesManagement'])->name('admin.medicalFacilitiesManagement');
    Route::get('admin/systemModification', [App\Http\Controllers\AdminController::class, 'systemModification'])->name('admin.systemModification');
    Route::get('admin/auditReport', [App\Http\Controllers\AdminController::class, 'auditReport'])->name('admin.auditReport');
    Route::get('admin/inventory', [App\Http\Controllers\AdminController::class, 'inventory'])->name('admin.inventory');
    Route::get('admin/exportBloodInventory', [App\Http\Controllers\AdminController::class, 'exportBloodInventory'])->name('admin.exportBloodInventory');
    Route::get('admin/exportBloodUsage', [App\Http\Controllers\AdminController::class, 'exportBloodUsage'])->name('admin.exportBloodUsage');
    Route::get('admin/exportBloodWastage', [App\Http\Controllers\AdminController::class, 'exportBloodWastage'])->name('admin.exportBloodWastage');
    Route::get('admin/exportDonationRecords', [App\Http\Controllers\AdminController::class, 'exportDonationRecords'])->name('admin.exportDonationRecords');
    Route::get('admin/exportEvent', [App\Http\Controllers\AdminController::class, 'exportEvent'])->name('admin.exportEvent');
    Route::get('admin/exportUserSummary', [App\Http\Controllers\AdminController::class, 'exportUserSummary'])->name('admin.exportUserSummary');
    Route::get('admin/notification', [App\Http\Controllers\AdminController::class, 'notification'])->name('admin.notification');

    Route::post('admin/toggleUserActivation/{userId}', [App\Http\Controllers\AdminController::class, 'toggleUserActivation'])->name('admin.toggleUserActivation');
    Route::post('admin/createUser', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.createUser');
    Route::post('admin/editUser/{userId}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('admin/createMedicalFacility', [App\Http\Controllers\AdminController::class, 'createMedicalFacility'])->name('admin.createMedicalFacility');
    Route::post('admin/editMedicalFacility/{facilityId}', [App\Http\Controllers\AdminController::class, 'editMedicalFacility'])->name('admin.editMedicalFacility');
    Route::post('admin/updateSystemSettings', [App\Http\Controllers\AdminController::class, 'updateSystemSettings'])->name('admin.updateSystemSettings');
    Route::post('admin/markNotificationRead/{notificationId}', [App\Http\Controllers\AdminController::class, 'markNotificationAsRead'])->name('admin.markNotificationRead');
    Route::post('admin/markAllNotificationsRead', [App\Http\Controllers\AdminController::class, 'markAllNotificationsAsRead'])->name('admin.markAllNotificationsRead');
    Route::post('admin/deleteMedicalFacility/{facilityId}', [App\Http\Controllers\AdminController::class, 'deleteMedicalFacility'])->name('admin.deleteMedicalFacility');
});