<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $voterToken)
 * @method static paginate()
 * @method static create(array $array)
 * @method static count()
 */
class Token extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'voter_id',
        'token',
        'otp',
        'is_used',
        'is_sent_email',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'token';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }
}
