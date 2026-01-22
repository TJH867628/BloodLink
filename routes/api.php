<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventOrganizerController;

Route::post('/event_organizer/createEvent', [EventOrganizerController::class, 'createEvent']);