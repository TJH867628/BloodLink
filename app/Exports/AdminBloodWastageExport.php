<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\BloodBag;

class AdminBloodWastageExport implements FromCollection, WithHeadings
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
        return BloodBag::where('status', 'EXPIRED')
            ->whereBetween('expires_at', [$this->from, $this->to])
            ->orderBy('expires_at')
            ->get()
            ->map(function ($row) {
                return [
                    'id' => (string) $row->id,
                    'blood_type' => (string) $row->blood_type,
                    'expires_at' => (string) $row->expires_at,
                    'donation_record_id' => (string) $row->donation_record_id,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Blood Bag ID',
            'Blood Type',
            'Wasted At',
            'Donation Record ID'
        ];
    }
}
