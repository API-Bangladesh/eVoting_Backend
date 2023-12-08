<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array)
 * @method static find($id)
 * @method static first()
 */
class Ballot extends Model
{
    use Loggable;

    /**
     * @var array
     */
    protected $fillable = [
        'position_id',
        'vote_limit',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'ballot';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ballotItems()
    {
        return $this->hasMany(BallotItem::class)->with('candidate');
    }
}
