<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate()
 * @method static create(array $array)
 * @method static find($id)
 * @method static where(string $string, $candidateId)
 * @method static select(string $string)
 * @method static sum(string $string)
 * @method static get()
 */
class Candidate extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'position_id',
        'name',
        'icon',
        'counter',
        'offline_vote_count'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'candidate';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ballotItem(){
        return $this->hasOne(BallotItem::class);
    }
}
