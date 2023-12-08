<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static paginate()
 * @method static where(string $string, $name)
 * @method static create(array $array)
 * @method static find($id)
 * @method static whereNotIn(string $string, array $except)
 * @method static findOrFail(int $int)
 * @method static withTrashed()
 * @method static get()
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, Loggable, SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'image',
        'counter_officer_id',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that will be logged on activity logger.
     *
     * @var boolean
     */
    protected static $logFillable = true;

    /**
     * The only attributes that has been changed.
     *
     * @var boolean
     */
    protected static $logOnlyDirty = true;

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'user';

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole(Role::TYPE_SUPER_ADMIN);
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole(Role::TYPE_ADMIN);
    }

    /**
     * @return bool
     */
    public function isOfficer()
    {
        return $this->hasRole(Role::TYPE_OFFICER);
    }

    /**
     * @param mixed ...$roles
     * @return User
     */
    public function syncRoles(...$roles)
    {
        $this->roles()->detach();
        return $this->assignRole($roles);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function counterOfficer()
    {
        return $this->belongsTo(CounterOfficer::class);
    }
}
