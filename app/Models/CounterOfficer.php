<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate()
 * @method static create(array $array)
 * @method static find($id)
 */
class CounterOfficer extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'info'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'counter-officer';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function counter()
    {
        return $this->hasOne(Counter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
