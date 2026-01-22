<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    //
    public function eventDashboard()
    {
        return view('event_organizer.dashboard');
    }
    public function eventManagement()
    {
        return view('event_organizer.eventManagement');
    }
    public function participation()
    {
        return view('event_organizer.participation');
    }
}
