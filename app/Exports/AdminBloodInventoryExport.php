<?php

namespace App\Exports;

use App\Models\BloodInventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminBloodInventoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BloodInventory::get()
                ->map(function ($row) {
                return [
                    'medical_facilities_id' => (string) $row->medical_facilities_id,
                    'medical_facilities_name' => (string) $row->medicalFacility->name,
                    'blood_type' => (string) $row->blood_type,
                    'quantity'   => (string) $row->quantity,   //To avoid Export 0 as blank
                    'status'     => (string) $row->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Facility ID',
            'Facility Name',
            'Blood Type',
            'Quantity (Units)',
            'Stock Status'
        ];
    }
}

