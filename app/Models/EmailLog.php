<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate()
 * @method static latest()
 * @method static where(string $string, $address)
 */
class EmailLog extends Model
{
    use Loggable;

    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

    /**
     * @var string[]
     */
    protected $fillable = [
        'from',
        'to',
        'subject',
        'body',
        'headers',
        'attachments',
        'status',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'email-log';
}
