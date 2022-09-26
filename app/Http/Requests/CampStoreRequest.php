<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampStoreRequest extends FormRequest
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
            'title' => 'required|max:35|string|unique:camps,title',
            'price' => 'required|numeric'
        ];
    }
}
