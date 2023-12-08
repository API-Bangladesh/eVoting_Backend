<?php

use App\Facades\Setting;
use App\Models\Ballot;
use App\Models\Candidate;
use App\Models\Counter;
use App\Models\CounterOfficer;
use App\Models\EmailTemplate;
use App\Models\Permission;
use App\Models\Position;
use App\Models\Token;
use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Milon\Barcode\Facades\DNS1DFacade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Permission\Models\Role;

/**
 * @return \Illuminate\Contracts\Foundation\Application|mixed
 */
function setting()
{
    return app('setting');
}

/**
 * @return Candidate[]|\Illuminate\Database\Eloquent\Collection
 */
function get_candidate_list()
{
    return Candidate::all();
}

/**
 * @return array
 */
function get_counter_officer_list()
{
    $counterOfficers = CounterOfficer::all();

    $tmpOfficers = [];
    foreach ($counterOfficers as $counterOfficer) {
        $isExistCounterOfficer = User::where('counter_officer_id', $counterOfficer->id)->exists();

        if (!$isExistCounterOfficer) {
            array_push($tmpOfficers, $counterOfficer);
        }
    }

    return $tmpOfficers;
}

/**
 * @return Counter[]|\Illuminate\Database\Eloquent\Collection
 */
function get_counter_list()
{
    return Counter::all();
}

/**
 * @return array[]
 */
function get_email_template_categories()
{
    return [
        [
            'id' => EmailTemplate::ONLINE_APPLICATION_FORM,
            'text' => 'ONLINE_APPLICATION_FORM'
        ],
        [
            'id' => EmailTemplate::ONLINE_VOTING_INVITATION,
            'text' => 'ONLINE_VOTING_INVITATION'
        ],
        [
            'id' => EmailTemplate::ONLINE_VOTING_STARTED,
            'text' => 'ONLINE_VOTING_STARTED'
        ],
        [
            'id' => EmailTemplate::GENERAL,
            'text' => 'GENERAL'
        ]
    ];
}

/**
 * @param $category_id
 * @return mixed|null
 */
function get_email_category_name($category_id)
{
    $emailCategories = get_email_template_categories();

    foreach ($emailCategories as $emailCategory) {
        if ($emailCategory['id'] == $category_id) {
            return $emailCategory['text'];
        }
    }

    return Null;
}

/**
 * @param $id
 * @return string
 */
function get_email_sending_status($id)
{
    try {
        $emailTemplate = EmailTemplate::find($id);

        $currentDate = strtotime(Carbon::today());
        $scheduleDate = strtotime($emailTemplate->schedule_date);

        $currentTime = strtotime(Carbon::now());
        $scheduleTime = strtotime($emailTemplate->schedule_time);

        if ($currentDate >= $scheduleDate) {
            if ($currentTime >= $scheduleTime) {
                return "Email has been sent.";
            } else {
                return "Email will send by today.";
            }
        } else {
            return "Email is pending.";
        }
    } catch (\Exception $exception) {
        throw $exception;
    }
}

/**
 * @return \Illuminate\Database\Eloquent\Collection|Role[]
 */
function get_role_list()
{
    return Role::all();
}

/**
 * @return bool
 * @throws Exception
 */
function is_token_generated()
{
    try {
        $countOnlineVoters = Voter::where('is_online_voter', 1)->count();
        $countTokens = Token::count();

        if ($countOnlineVoters > 0 && $countTokens > 0) {
            return True;
        }
    } catch (\Exception $exception) {
        throw new Exception($exception->getMessage());
    }

    throw new Exception("Token & Voter can not be empty.");
}

/**
 * @param $dompdf
 * @return mixed
 */
function set_paper_size($dompdf)
{
    $orientation = Setting::get('orientation') ?? 'portrait';
    $paper_size = Setting::get('paper_size') ?? 'A4';

    if (Setting::get('paper_size') == 'custom') {
        $width = Setting::get('width') * 72;
        $height = Setting::get('height') * 72;
        $paper_size = [0, 0, $width, $height];
    }

    return $dompdf->setPaper($paper_size, $orientation);
}

/**
 * @param $request
 * @param $new_field
 * @param $old_field
 * @return string|null
 */
function do_upload_file($request, $new_field, $old_field)
{
    try {
        if ($request->hasFile($new_field)) {
            $fileUploadDir = get_upload_directory_path();

            $file = $request->file($new_field);
            $fileName = Str::random(12) . '.' . $file->getClientOriginalExtension();

            if ($file->move($fileUploadDir, $fileName)) {
                remove_file($request->$old_field);

                return "{$fileUploadDir}/{$fileName}";
            }
        }
    } catch (\Exception $exception) {
        throw $exception;
    }

    return $request->$old_field ?? Null;
}

/**
 * @param $old_file
 */
function remove_file($old_file)
{
    if (!empty($old_file) && file_exists(public_path($old_file))) {
        unlink(public_path(($old_file)));
    }
}

/**
 * @return string
 */
function get_upload_directory_path()
{
    $fileUploadDir = "uploads/";

    $yearFolder = $fileUploadDir . date("Y");
    $monthFolder = $yearFolder . '/' . date("m");
    $dirFolder = $monthFolder;

    if (!Storage::exists($yearFolder)) {
        Storage::makeDirectory($yearFolder);
    }

    if (!Storage::exists($monthFolder)) {
        Storage::makeDirectory($monthFolder);
    }

    return $dirFolder;
}

/**
 * @param null $path
 * @param string $source
 * @return string
 */
function get_uploaded_file_url($path = null, $source = 'asset')
{
    if (!$path) {
        return get_placeholder_image($source);
    }

    if ($source == 'public') {
        return public_path($path);
    }

    return asset($path);
}

/**
 * @param string $source
 * @return string
 */
function get_placeholder_image($source = 'asset')
{
    if ($source == 'public') {
        return public_path("assets/img/no-image.png");
    }

    return asset("assets/img/no-image.png");
}

/**
 * @return bool
 */
function is_enable_online_voting_function()
{
    return Setting::get('enable_voting_functions') == \App\Models\Setting::VFN_ONLINE || Setting::get('enable_voting_functions') == \App\Models\Setting::VFN_BOTH;
}

/**
 * @return bool
 */
function is_enable_offline_voting_function()
{
    return Setting::get('enable_voting_functions') == \App\Models\Setting::VFN_OFFLINE || Setting::get('enable_voting_functions') == \App\Models\Setting::VFN_BOTH;
}

/**
 * @param $string
 * @return bool
 */
function is_json($string)
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * @return mixed
 */
function get_count_total_voters()
{
    return Voter::count();
}

/**
 * @return mixed
 */
function get_count_online_voters()
{
    return Voter::where('is_online_voter', 1)->count();
}

/**
 * @return mixed
 */
function get_count_offline_voters()
{
    return Voter::whereNull('is_online_voter')->count();
}

/**
 * @return mixed
 */
function get_count_online_check_in()
{
    return Voter::where('is_online_voter', 1)->where('is_checked_in', 1)->count();
}

/**
 * @return mixed
 */
function get_count_offline_check_in()
{
    return Voter::whereNull('is_online_voter')->where('is_checked_in', 1)->count();
}

/**
 * @return mixed
 */
function get_count_online_casted_votes()
{
    return Vote::count();
}

/**
 * @return mixed
 */
function get_count_offline_casted_votes()
{
    try {
        $firstPosition = Position::first();

        $offlineVotes = Position::query()
            ->from('positions')
            ->leftJoin('ballots', 'ballots.position_id', '=', 'positions.id')
            ->leftJoin('ballot_items', 'ballot_items.ballot_id', '=', 'ballots.id')
            ->leftJoin('candidates', 'candidates.id', '=', 'ballot_items.candidate_id')
            ->where('positions.id', $firstPosition->id)
            ->sum('candidates.offline_vote_count');

        $ballot = Ballot::first();

        $totalValidBallots = $offlineVotes / $ballot->vote_limit;
    } catch (Exception $exception) {
        report($exception);

        return 0;
    }

    return $totalValidBallots;
}

/**
 * @return float|int|mixed
 */
function get_count_total_casted_votes()
{
    return get_count_online_casted_votes() + get_count_offline_casted_votes();
}

/**
 * @return mixed
 */
function get_count_online_absent_voters()
{
    return get_count_online_voters() - get_count_online_casted_votes();
}

/**
 * @return float|int|mixed
 */
function get_count_offline_absent_voters()
{
    return get_count_offline_voters() - get_count_offline_casted_votes();
}

/**
 * @return float|int|mixed
 */
function get_count_total_absent_voters()
{
    return get_count_online_absent_voters() + get_count_offline_absent_voters();
}

/**
 * Chunk larger data before rendering pdf
 *
 * @param $total
 * @return array
 */
function chunk_files_with_paginate_data($total)
{
    $filesOffsetData = [];

    $limit = Setting::get('max_limit') ?? 100;

    $files = ceil($total / $limit);

    for ($file = 1; $file <= $files; $file++) {
        $start = 0;
        $end = $limit;

        if ($file > 1) {
            $end = $file * $limit;
            $start = $end - $limit;
        }

        $data = [
            'start' => $start,
            'end' => $end,
            'limit' => $limit,
        ];

        array_push($filesOffsetData, $data);
    }

    return $filesOffsetData;
}

/**
 * Determine QrCode or Barcode
 *
 * @param $code
 * @return void|mixed
 */
function get_qr_code_or_barcode($code)
{
    if (Setting::get('print_code') == 'qrcode') {
        $svg = QrCode::size(50)->generate($code);
        echo '<img src="data:image/svg+xml;base64,' . base64_encode($svg) . '" />';
    } else {
        echo DNS1DFacade::getBarcodeHTML($code, 'C39');
    }
}

/**
 * Get permission name list only
 *
 * @return mixed
 */
function get_permission_name_list()
{
    return Permission::orderBy('name', 'ASC')->pluck('name');
}

/**
 * Get generated permission list as modular system
 *
 * Example: ['articles': ['read' => 'read articles']]
 *
 * @return array
 */
function get_generated_permissions()
{
    $array = [];

    foreach (get_permission_name_list() as $permissionName) {
        $pieces = explode(" ", $permissionName);
        if (empty($pieces)) continue;
        if (count($pieces) < 2) continue;

        // Get action & module
        list($action, $module) = $pieces;

        // Associate key/value pairs
        $array[$module][$action] = $permissionName;
    }

    $collection = collect($array);
    $sorted = $collection->sortKeys();

    return $sorted->all();
}

/**
 * @param string $string
 * @return string
 */
function get_dashes_to_title_case($string = '')
{
    return Str::title(Str::replace('-', ' ', $string));
}
