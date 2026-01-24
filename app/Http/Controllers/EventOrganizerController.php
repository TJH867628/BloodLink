<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Event;
use Illuminate\Http\Request;
use App\Models\Event as EventModel;
use App\Models\Appointment;
use Carbon\Carbon;
use DB;

class EventOrganizerController extends Controller
{
    //
    public function eventOrganizerDashboard()
    {
        $user = auth()->user();
        $today = now()->toDateString();
        $events = EventModel::where('organizer_id', auth()->id())->where('event.date', '>=', $today)->get();
        $totalRegisteredDonors = EventModel::where('organizer_id', auth()->id())
            ->where('event.status', 'ACTIVE')
            ->where('event.date', '>=', $today)
            ->join('appointment', 'event.id', '=', 'appointment.event_id')
            ->where('appointment.status', 'ACCEPTED')
            ->count();

        $totalPendingAcceptDonors = EventModel::where('organizer_id', auth()->id())
            ->where('event.status', 'ACTIVE')
            ->where('event.date', '>=', $today)
            ->join('appointment', 'event.id', '=', 'appointment.event_id')
            ->where('appointment.status', 'PENDING')
            ->count();

        $totalSlotCapacity = EventModel::where('organizer_id', auth()->id())
            ->where('event.status', 'ACTIVE')
            ->where('event.date', '>=', $today)
            ->sum('total_slots');

        $totalBookedSlots = EventModel::where('organizer_id', auth()->id())
            ->where('event.status', 'ACTIVE')
            ->where('event.date', '>=', $today)
            ->join('appointment', 'event.id', '=', 'appointment.event_id')
            ->whereIn('appointment.status', ['ACCEPTED', 'PENDING'])
            ->count();

        $slotCapacityInPercent = $totalSlotCapacity > 0 ? ($totalBookedSlots / $totalSlotCapacity) * 100 : 0;
        $slotCapacity = round($slotCapacityInPercent, 2);
        return view('Event_Organizer.dashboard', compact('user','events','totalRegisteredDonors','totalPendingAcceptDonors','slotCapacity'));
    }
    public function eventManagement()
    {
        $events = EventModel::where('organizer_id', auth()->id())->get();
        return view('Event_Organizer.eventManagement',compact('events'));
    }
    public function participation()
    {
        $appoinments = DB::table('appointment')
        ->join('event', 'appointment.event_id', '=', 'event.id')
        ->join('users', 'appointment.donor_id', '=', 'users.id')
        ->where('event.organizer_id', auth()->id())
        ->select(
            'appointment.id',
            'appointment.status',
            'event.name as event_name',
            'event.date as event_date',
            'event.time as event_time',
            'users.name as donor_name',
            'users.phone'
        )
        ->orderBy('appointment.created_at', 'desc')
        ->get();

        $events = EventModel::where('organizer_id', auth()->id())->get();
        
        return view('Event_Organizer.participation',compact('appoinments','events'));
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

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Created event: ' . $request->input('event_name'),
            'timestamp' => now(),
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

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Deleted event: ' . $event->id . ' ' . $event->name,
            'timestamp' => now(),
        ]);

        return redirect()->route('event_organizer.eventManagement')->with('success', 'Event deleted successfully.');
    }

    public function acceptAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = 'ACCEPTED';
        $appointment->save();
        $event = EventModel::where('id', $appointment->event_id)->first();
        $eventDate = Carbon::parse($event->date);
        $start = $eventDate->copy()->subMonths(3);
        $end   = $eventDate->copy()->addMonths(3);

        DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->where('appointment.donor_id', $appointment->donor_id)
            ->where('appointment.status', 'PENDING')
            ->whereBetween('event.date', [
                $start->toDateString(),
                $end->toDateString()
            ])
            ->where('appointment.id', '!=', $appointment->id)   // do not reject the accepted one
            ->update([
                'appointment.status' => 'REJECTED'
            ]);

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Accepted appointment ID: ' . $appointmentId,
            'timestamp' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Appointment accepted successfully.');
    }

    public function rejectAppointment($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $event = EventModel::findOrFail($appointment->event_id);
        $appointment->status = 'REJECTED';
        $event->available_slots += 1;
        $appointment->save();
        $event->save();

        AuditLog::create([
            'user_id' => auth()->user()->id,
            'action' => 'Rejected appointment ID: ' . $appointmentId,
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Appointment rejected successfully.');
    }
}
