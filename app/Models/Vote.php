<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method create(array[] $array)
 * @method static count()
 * @method static find($id)
 * @method static pluck(string $string)
 * @method static get()
 */
class Vote extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'candidate_ids',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'candidate_ids' => 'array'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'vote';
}
