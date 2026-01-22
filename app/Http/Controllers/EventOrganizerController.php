<?php

namespace App\Http\Controllers;

use Event;
use Illuminate\Http\Request;
use App\Models\Event as EventModel;

class EventOrganizerController extends Controller
{
    //
    public function eventOrganizerDashboard()
    {
        $user = auth()->user();
        return view('Event_Organizer.dashboard', compact('user'));
    }
    public function eventManagement()
    {
        $events = EventModel::where('organizer_id', auth()->id())->get();
        return view('Event_Organizer.eventManagement',compact('events'));
    }
    public function participation()
    {
        return view('Event_Organizer.participation');
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'event_name'   => 'required|string|max:255',
            'event_date'   => 'required|date',
            'event_time'   => 'required',
            'location'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'total_slots'  => 'required|integer|min:1'
        ]);

        EventModel::create([
            'name'   => $request->input('event_name'),
            'date'   => $request->input('event_date'),
            'time'   => $request->input('event_time'),
            'location'     => $request->input('location'),
            'details'  => $request->input('description'),
            'total_slots'  => $request->input('total_slots'),
            'available_slots' => $request->input('total_slots'),
            'status'       => 'ACTIVE',
            'organizer_id' => auth()->id()
            // 'organizer_id' => 2
        ]);

        return redirect()->route('event_organizer.eventManagement')->with('success', 'Event created successfully.');
    }

    public function editEvent(Request $request, $eventId)
    {
        // Implementation for editing an event
        $request->validate([
            'event_name'   => 'required|string|max:255',
            'event_date'   => 'required|date',
            'event_time'   => 'required',
            'location'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'total_slots'  => 'required|integer|min:1'
        ]);

        $event = EventModel::findOrFail($eventId);
        $event->update([
            'name'   => $request->input('event_name'),
            'date'   => $request->input('event_date'),
            'time'   => $request->input('event_time'),
            'location'     => $request->input('location'),
            'details'  => $request->input('description'),
            'total_slots'  => $request->input('total_slots'),
            'available_slots' => $event->available_slots + ($request->input('total_slots') - $event->total_slots),
        ]);

        return redirect()->route('event_organizer.eventManagement')->with('success', 'Event updated successfully.');
    }

    public function deleteEvent(Request $request, $eventId)
    {
        $event = EventModel::findOrFail($eventId);

        if ($event->organizer_id !== auth()->id()) {
            return redirect()->route('event_organizer.eventManagement')->with('error', 'Unauthorized action.');
        }

        if ($event->available_slots < $event->total_slots) {
            return redirect()->route('event_organizer.eventManagement')->with('error', 'Cannot delete event with existing bookings.');
        }
        $event->delete();

        return redirect()->route('event_organizer.eventManagement')->with('success', 'Event deleted successfully.');
    }
}
