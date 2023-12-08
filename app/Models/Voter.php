<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, $voter_id)
 * @method static find($voter_id)
 * @method static paginate()
 * @method static whereNull(string $string)
 * @method static count()
 * @method static create(array $array)
 * @method static select(string $string, string $string1, string $string2, string $string3, string $string4)
 * @method static whereNotNull(string $string)
 * @method static skip($offset)
 * @method static offset($offset)
 */
class Voter extends Model
{
    use SoftDeletes, Loggable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'member_id',
        'category',
        'email_address',
        'contact_number',
        'image',
        'is_online_voter',
        'is_checked_in',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'voter';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token()
    {
        return $this->hasOne(Token::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function offlineToken()
    {
        return $this->hasOne(OfflineToken::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function application()
    {
        return $this->hasOne(Application::class);
    }
}
