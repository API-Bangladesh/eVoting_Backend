<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 * @method static create(array $array)
 * @method static paginate()
 * @method static findOrFail($id)
 * @method static latest()
 */
class OfflineToken extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'voter_id',
        'counter_id',
        'card_no',
        'token',
        'phone',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'offline-token';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
