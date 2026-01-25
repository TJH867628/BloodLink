<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Event;

class AdminEventExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    //Event export within date range and total slot and booked slot
    public function collection()
    {
        return Event::whereBetween('date', [$this->from, $this->to])
                ->get()
                ->map(function ($row) {
                return [
                    'id' => (string) $row->id,
                    'event_name' => (string) $row->name,
                    'date' => (string) $row->date,
                    'time' => (string) $row->time,
                    'total_slots'     => (string) $row->total_slots,
                    'booked_slots'     => (string) ($row->total_slots - $row->available_slots),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Event ID',
            'Event Name',
            'Event Date',
            'Location',
            'Total Slots',
            'Booked Slots'
        ];
    }
    
}
