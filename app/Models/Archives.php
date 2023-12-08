<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archives extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'total_voters',
        'online_voters',
        'offline_voters',
        'vote_cast_online',
        'vote_cast_offline',
        'total_vote_cast',
        'total_candidate',
        'total_position',
        'vote_by_candidate',
        'elected'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'archive';
}
