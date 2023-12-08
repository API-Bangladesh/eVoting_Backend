<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate()
 * @method static create(array $array)
 * @method static find($id)
 * @method static first()
 * @method static select(string $string)
 */
class Position extends Model
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'position';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ballot(){
        return $this->hasOne(Ballot::class);
    }
}
