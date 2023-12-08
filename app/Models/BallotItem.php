<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 * @method static whereIn(string $string, \Illuminate\Support\Collection $candidateIds)
 * @method static where(string $string, $candidateId)
 */
class BallotItem extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'ballot_id',
        'candidate_id',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'ballotitem';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ballot()
    {
        return $this->belongsTo(Ballot::class);
    }
}
