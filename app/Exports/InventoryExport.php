<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\BloodInventory;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryExport implements FromCollection, WithHeadings
{
    protected $facilityId;

    public function __construct($facilityId)
    {
        $this->facilityId = $facilityId;
    }

    public function collection()
    {
        return BloodInventory::where('medical_facilities_id', $this->facilityId)
            ->get()
            ->map(function ($row) {
                return [
                    'blood_type' => (string) $row->blood_type,
                    'quantity'   => (string) $row->quantity,   //To avoid Export 0 as blank
                    'status'     => (string) $row->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Blood Type',
            'Quantity',
            'Status',
        ];
    }
}
