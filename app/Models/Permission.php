<?php

namespace App\Models;

use App\Common\Loggable;
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * @method static updateOrCreate(array|string[] $array)
 * @method static paginate()
 * @method static find($id)
 * @method static orderBy(string $string, string $string1)
 */
class Permission extends SpatiePermission
{
    use Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'permission';
}
