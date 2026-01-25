<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\BloodBag;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BloodUsageExport implements FromCollection, WithHeadings
{
    protected $facilityId, $from, $to;

    public function __construct($facilityId, $from, $to)
    {
        $this->facilityId = $facilityId;
        $this->from = $from;
        $this->to   = $to;
    }

    public function collection()
    {
        return BloodBag::where('facility_id', $this->facilityId)
            ->where('status','USED')
            ->whereBetween('used_at', [$this->from, $this->to])
            ->select('id','blood_type','used_at','donation_record_id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Blood Bag ID',
            'Blood Type',
            'Used At',
            'Donation Record ID',
        ];
    }
}
