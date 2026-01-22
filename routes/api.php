<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventOrganizerController;
    Route::post('event_organizer/deleteEvent/{id}', [EventOrganizerController::class, 'deleteEvent'])->name('event_organizer.deleteEvent'); 
