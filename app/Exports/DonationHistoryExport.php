<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\DonationRecord;

class DonationHistoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DonationRecord::where('facility_id', auth()->user()->facility_id)
            ->get()
            ->map(function ($record) {
                return [
                    'Donation ID'       => $record->id,
                    'Donor ID'          => $record->donor_id,
                    'Donation Date'     => $record->donation_date,
                    'Status'            => $record->status,
                    'Hemoglobin'        => $record->hemoglobin,
                    'Blood Pressure'    => $record->blood_pressure,
                    'Heart Rate'        => $record->heart_rate,
                    'Temperature'       => $record->temperature,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Donation ID',
            'Donor ID',
            'Donation Date',
            'Status',
            'Hemoglobin',
            'Blood Pressure',
            'Heart Rate',
            'Temperature',
        ];
    }
}
