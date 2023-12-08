<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CounterRequest extends FormRequest
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
        return [
            'counter_number' => 'required|numeric|unique:counters,counter_number,' . $this->id,
            'counter_name' => 'required|unique:counters,counter_name,' . $this->id,
            'counter_officer_id' => 'required|unique:counters,counter_officer_id,' . $this->id,
        ];
    }
}
