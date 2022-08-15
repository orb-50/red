<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' =>'required',
            'open' =>'required',
            'status' =>'required',
            'priority' =>'required',
            'sStartAt' =>'required',
            'sFinishAt' =>'required',
            'progress' =>'required',
            'work_hours' =>'required|numeric',
        ];
    }
}
