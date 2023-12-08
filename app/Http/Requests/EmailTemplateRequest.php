<?php

namespace App\Http\Requests;

use App\Models\EmailTemplate;
use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
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
        $rules = [
            'subject' => 'required|unique:email_templates,subject,' . $this->id,
            'body' => 'required',
            'sms' => 'nullable|max:160',
        ];

        if ($this->category_id == EmailTemplate::GENERAL) {
            $rules['receiver_type_id'] = 'required';
        }

        if ($this->method() == 'POST') {
            $rules['category_id'] = 'required';
        }

        return $rules;
    }
}
