<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintSettingRequest extends FormRequest
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
        $rules['position'] = 'required';
        $rules['orientation'] = 'required';
        $rules['paper_size'] = 'required';
        $rules['print_code'] = 'required';
        $rules['max_limit'] = 'required|numeric';

        if ($this->paper_size == 'custom') {
            $rules['width'] = 'required|numeric';
            $rules['height'] = 'required|numeric';
        }

        return $rules;
    }
}
