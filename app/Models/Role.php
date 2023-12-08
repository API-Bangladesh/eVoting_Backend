<?php

namespace App\Models;

use App\Common\Loggable;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @method static paginate()
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static whereNotIn(string $string, array $array)
 */
class Role extends SpatieRole
{
    use Loggable;

    const TYPE_SUPER_ADMIN = "Super Admin";
    const TYPE_ADMIN = "Admin";
    const TYPE_OFFICER = "Officer";

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
    protected static $logName = 'role';
}
