<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoterRequest extends FormRequest
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
            'name' => 'required|max:40',
            'member_id' => 'required|max:20|unique:voters,member_id,' . $this->id,
            'category' => 'required|max:20',
            'email_address' => 'required|max:40|unique:voters,email_address,' . $this->id,
            'contact_number' => 'required|max:14|unique:voters,contact_number,' . $this->id,
            'image' => 'nullable|file|mimes:jpeg,jpg,png|max:10240',
        ];

        /*if ($this->isMethod('post')) {
            $rules['image'] = 'required|file|mimes:jpeg,jpg,png|max:10240';
        }*/

        return $rules;
    }
}
