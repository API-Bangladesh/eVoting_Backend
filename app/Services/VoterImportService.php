<?php

namespace App\Services;

use App\Models\Voter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VoterImportService implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return Voter|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     */
    public function model(array $row)
    {
        return new Voter([
            'name' => $row['name'],
            'member_id' => $row['member_id'],
            'category' => $row['category'],
            'email_address' => $row['email_address'],
            'contact_number' => $row['contact_number'],
        ]);
    }
}
