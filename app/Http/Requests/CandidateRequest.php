<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
            'name' => 'required|unique:candidates,name,' . $this->id,
            'icon' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
        ];

        if ($this->isMethod('post')) {
            $rules['icon'] = 'required|file|mimes:jpeg,jpg,png|max:5120';
        }

        return $rules;
    }
}
