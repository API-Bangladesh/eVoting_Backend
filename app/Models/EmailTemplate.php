<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 * @method static create(array $array)
 * @method static paginate()
 * @method static where(string $string, \Illuminate\Support\Carbon $today)
 * @method static findOrFail($id)
 */
class EmailTemplate extends Model
{
    use Loggable;

    const ONLINE_APPLICATION_FORM = 1;
    const ONLINE_VOTING_INVITATION = 2;
    const ONLINE_VOTING_STARTED = 3;
    const GENERAL = 5;

    const RECEIVER_ALL_VOTERS = 1;
    const RECEIVER_ALL_ONLINE_VOTERS = 2;
    const RECEIVER_ALL_OFFLINE_VOTERS = 3;

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'receiver_type_id',
        'subject',
        'body',
        'sms',
        'counter',
        'sent_logs',
        'schedule_date',
        'schedule_time'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'sent_logs' => 'array',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'emailtemplate';
}
