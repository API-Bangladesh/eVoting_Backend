<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VotingScheduleSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        $rules['election_year'] = 'required|numeric';
        $rules['voting_schedule_start_date'] = 'required';

        if (is_enable_offline_voting_function()) {
            $rules['officer_secret_code'] = 'required|numeric';
        }

        return $rules;
    }
}
