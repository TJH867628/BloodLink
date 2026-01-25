<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Event;
use Illuminate\Http\Request;
use App\Models\Event as EventModel;
use App\Models\Notification as NotificationModel;
use App\Models\Appointment;
use App\Exports\ParticipationExport;
use Carbon\Carbon;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelFormat;

class EventOrganizerController extends Controller
{
    //
    public function eventOrganizerDashboard()
    {
        $user = auth()->user();
        $today = now()->toDateString();
        $events = EventModel::where('organizer_id', auth()->id())->where('event.date', '>=', $today)->limit(5)->get();
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
        
        $hasUnreadNotifications = NotificationModel::where('user_id', auth()->id())
            ->where('status', 'SEND')
            ->exists();

        $slotCapacityInPercent = $totalSlotCapacity > 0 ? ($totalBookedSlots / $totalSlotCapacity) * 100 : 0;
        $slotCapacity = round($slotCapacityInPercent, 2);
        return view('Event_Organizer.dashboard', compact('user','events','totalRegisteredDonors','totalPendingAcceptDonors','slotCapacity','hasUnreadNotifications'));
    }
    public function eventManagement()
    {
        $user = auth()->user();
        $events = EventModel::where('organizer_id', auth()->id())->get();
        return view('Event_Organizer.eventManagement',compact('events', 'user'));
    }
    public function participation()
    {
        $user = auth()->user();
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
        
        return view('Event_Organizer.participation',compact('appoinments','user', 'events'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('Event_Organizer.profile', compact('user'));
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

        sendSystemNotification($appointment->donor, 'Your appointment for the event "' . $event->name . '" on ' . $event->date . ' has been accepted.');
        
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

        sendSystemNotification($appointment->donor, 'Your appointment for the event "' . $event->name . '" on ' . $event->date . ' has been rejected.');

        return redirect()->back()->with('success', 'Appointment rejected successfully.');
    }

    public function notification () {
        $user = Auth::user();
        $notifications = NotificationModel::where('user_id', $user->id)
            ->orderByRaw("status = 'READ'")
            ->orderBy('datetime', 'desc')
            ->get();
        return view('event_organizer.notification', compact('user','notifications'));
    }

    public function markNotificationAsRead(Request $request, $notificationId) {
        $user = Auth::user();

        $notification = NotificationModel::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->first();

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }

        $notification->status = 'READ';
        $notification->save();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    public function markAllNotificationsAsRead(Request $request) {
        $user = Auth::user();

        NotificationModel::where('user_id', $user->id)
            ->where('status', 'SEND')
            ->update(['status' => 'READ']);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);
        if (!password_verify($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($request->input('new_password') !== $request->input('confirm_password')) {
            return redirect()->back()->with('error', 'New password and confirmation do not match.');
        }

        if($request->input('current_password') === $request->input('new_password')) {
            return redirect()->back()->with('error', 'New password cannot be the same as the current password.');
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Changed account password',
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->save();

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'Updated profile information',
            'timestamp' => now(),
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function exportParticipation(Request $request)
    {
        $eventId = $request->query('eventId', 'all');
        $type = $request->query('type', 'xlsx');

        // Check ALL events data
        if ($eventId === 'all') {
            $totalCount = Appointment::whereHas('event', function($q) {
                $q->where('organizer_id', auth()->id());
            })->count();

            if ($totalCount == 0) {
                return redirect()->back()->with('error', 'No participation data available.');
            }

            $filename = 'all_events_donor_participation.xlsx';
        }
        else {
            $event = DB::table('event')->where('id', $eventId)->first();

            if (!$event) {
                return redirect()->back()->with('error', 'Selected event not found.');
            }

            $participationCount = Appointment::where('event_id', $eventId)->count();

            if ($participationCount == 0) {
                return redirect()->back()->with('error', 'No participation data available for the selected event.');
            }

            $eventName = str_replace(' ', '_', strtolower($event->name));
            $filename = $eventName . '_donor_participation.xlsx';
        }

        // CSV
        if ($type === 'csv') {
            $filename = str_replace('.xlsx', '.csv', $filename);

            return Excel::download(
                new ParticipationExport($eventId),
                $filename,
                ExcelFormat::CSV
            );
        }

        // XLSX
        return Excel::download(
            new ParticipationExport($eventId),
            $filename,
            ExcelFormat::XLSX
        );
    }
}
