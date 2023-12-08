<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GlobalSettingRequest extends FormRequest
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

        $rules['organization_name'] = 'required';
        $rules['icon'] = 'nullable|file|mimes:jpeg,jpg,png|max:5120';
        $rules['logo_type'] = 'required';

        if(is_enable_online_voting_function()){
            $rules['online_application_form_url'] = 'required';
            $rules['online_voting_url'] = 'required';
        }

        return $rules;
    }
}
