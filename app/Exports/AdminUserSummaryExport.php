<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;

class AdminUserSummaryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::get()
                ->map(function ($row) {
                return [
                    'id' => (string) $row->id,
                    'name' => (string) $row->name,
                    'email' => (string) $row->email,
                    'phone' => (string) $row->phone,
                    'role'   => (string) $row->role,   
                    'created_at'     => (string) $row->created_at,
                    'updated_at'     => (string) $row->updated_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Name',
            'Email',
            'Phone',
            'Role',
            'Created At',
            'Updated At'
        ];
    }
}
