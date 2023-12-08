<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $voter_id)
 * @method static paginate()
 * @method static create(array $array)
 * @method static whereIn(string $string, $ids)
 * @method static offset(int $start)
 * @method static count()
 */
class Application extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'voter_id',
        'form_data',
        'is_approved',
        'is_declined',
        'declined_reason',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'form_data' => 'array'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'application';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function voter()
    {
        return $this->belongsTo(Voter::class);
    }
}
