<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingRequest extends FormRequest
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

        $rules['mail_mailer'] = 'required';
        if ($this->mail_mailer == 'ses') {
            $rules['aws_access_key'] = 'required';
            $rules['aws_secret_key'] = 'required';
            $rules['aws_region'] = 'required';
        }

        $rules['mail_host'] = 'required';
        $rules['mail_port'] = 'required|numeric';
        $rules['mail_encryption'] = 'required';
        $rules['mail_username'] = 'required';
        $rules['mail_password'] = 'required';
        $rules['mail_from_address'] = 'required';
        $rules['mail_from_name'] = 'required';

        return $rules;
    }
}
