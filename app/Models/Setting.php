<?php

namespace App\Models;

use App\Common\Loggable;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static first()
 * @method static findOrFail($id)
 * @method static firstOrFail()
 * @method static find($id)
 */
class Setting extends Model
{
    use Loggable;

    /**
     * Voting Function Define
     * @var int
     */
    const VFN_ONLINE = 1;
    const VFN_OFFLINE = 2;
    const VFN_BOTH = 3;

    /**
     * @var string[]
     */
    protected $fillable = [
        'organization_name',
        'icon',
        'address',
        'logo_type',
        'election_schedule_date',
        'election_interval',
        'application_submission_form',
        'online_application_form_url',
        'online_voting_url',
        'election_year',

        'voting_schedule_start_date',
        'voting_schedule_start_time',
        'voting_schedule_end_time',
        'application_subscription_start_date',
        'application_subscription_end_date',
        'ballot_merge_all',
        'officer_secret_code',
        'lock_qr_code',
        'lock_online_token',
        'email_category',

        'disable_common_users_login',
        'disable_voters_import',
        'disable_voters_deletion',
        'disable_permanently_voters_deletion',
        'offline_checked_in_status',
        'display_voting_result',
        'disable_offline_voting_result_upload',
        'enable_sms_gateway_service',
        'enable_voting_functions',

        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_encryption',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',

        'aws_access_key',
        'aws_secret_key',
        'aws_region',
        'ballot_print',

        'print_code',
        'position',
        'orientation',
        'paper_size',
        'width',
        'height',
        'max_limit',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'application_submission_form' => 'array'
    ];

    /**
     * The name that will be used when log this model. (optional)
     *
     * @var boolean
     */
    protected static $logName = 'setting';
}
