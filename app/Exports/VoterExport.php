<?php

namespace App\Exports;

use App\Models\Voter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoterExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Voter::select('name', 'member_id', 'category', 'email_address', 'contact_number')->get();
    }

    /**
     * @return array|string[]
     */
    public function headings(): array
    {
        return ["Name", "Member Id", "Category", "Email Address", "Contact Number"];
    }
}