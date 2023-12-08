<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidateExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function collection()
    {
        return Candidate::query()
            ->select('candidates.name as candidate_name', 'positions.name as position_name')
            ->from('candidates')
            ->leftJoin('ballot_items', 'ballot_items.candidate_id', '=', 'candidates.id')
            ->leftJoin('ballots', 'ballots.id', '=', 'ballot_items.ballot_id')
            ->leftJoin('positions', 'positions.id', '=', 'ballots.position_id')
            ->get();
    }

    /**
     * @return array|string[]
     */
    public function headings(): array
    {
        return ["Name", "Position"];
    }
}