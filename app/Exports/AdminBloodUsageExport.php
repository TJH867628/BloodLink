<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\BloodBag;

class AdminBloodUsageExport implements FromCollection, WithHeadings
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = Carbon::parse($from)->startOfDay();   // 00:00:00
        $this->to   = Carbon::parse($to)->endOfDay();       // 23:59:59
    }

    public function collection()
    {
        return BloodBag::where('status', 'USED')
            ->whereBetween('used_at', [$this->from, $this->to])
            ->orderBy('used_at')
            ->get()
            ->map(function ($row) {
                return [
                    'id' => (string) $row->id,
                    'blood_type' => (string) $row->blood_type,
                    'used_at' => Carbon::parse($row->used_at)->format('Y-m-d H:i'),
                    'donation_record_id' => (string) $row->donation_record_id,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Blood Bag ID',
            'Blood Type',
            'Used At',
            'Donation Record ID'
        ];
    }
}
