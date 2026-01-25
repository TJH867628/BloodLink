<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ParticipationExport implements FromCollection, WithHeadings
{
    private $eventId;

    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    public function collection()
    {
        $query = DB::table('appointment')
            ->join('event', 'appointment.event_id', '=', 'event.id')
            ->join('users', 'appointment.donor_id', '=', 'users.id')
            ->where('event.organizer_id', auth()->id())
            ->select(
                'appointment.id',
                'appointment.status',
                'event.name as event_name',
                'event.date',
                'event.time',
                'users.name',
                'users.phone'
            )
            ->orderBy('appointment.created_at', 'desc');

        if ($this->eventId !== 'all') {
            $query->where('event.id', $this->eventId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Appointment ID',
            'Status',
            'Event Name',
            'Event Date',
            'Event Time',
            'Donor Name',
            'Donor Phone'
        ];
    }
}