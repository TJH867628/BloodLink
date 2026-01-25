<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\DonationRecord;

class AdminDonationRecordsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $from, $to;
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }
    public function collection()
    {
        return DonationRecord::whereBetween('collected_date', [$this->from, $this->to])
                ->get()
                ->map(function ($row) {
                return [
                    'id' => (string) $row->id,
                    'donor_id' => (string) $row->donor_id,
                    'donor_name' => (string) $row->donor->name,
                    'collected_date' => (string) $row->collected_date,
                    'event_name' => (string) $row->event->name,
                    'unit'     => (string) $row->unit,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Donation Record ID',
            'Donor ID',
            'Donor Name',
            'Collected Date',
            'Event Name',
            'Quantity (Units)'
        ];
    }
}
