<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate()
 * @method static where(string $string, $scan_input)
 * @method static find($id)
 * @method static create(array $array)
 * @method static latest(string $string)
 * @method static offset(int $start)
 * @method static count()
 * @method static whereNotNull(string $string)
 * @method static whereNull(string $string)
 */
class QrCode extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'is_used',
        'scan_blank_ballot',
        'scan_voted_ballot',
        'validated_by',
        'verified_by',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'qrcode';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function validatedBy()
    {
        return $this->belongsTo(User::class, 'validated_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'id');
    }
}
