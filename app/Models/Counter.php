<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static find($id)
 * @method static where(string $string, $counter_number)
 */
class Counter extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'counter_number',
        'counter_name',
        'counter_officer_id'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'counter';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function counterOfficer()
    {
        return $this->belongsTo(CounterOfficer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offlineTokens()
    {
        return $this->hasMany(OfflineToken::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function qrCodes()
    {
        return $this->hasMany(QrCode::class);
    }
}
