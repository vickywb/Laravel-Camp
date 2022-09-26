<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadProfileRequest extends FormRequest
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
            'name' => 'nullable',
            'occupation' => 'nullable',
            'address' => 'nullable',
            'phone_number' => 'nullable|numeric|digits_between:12,13',
            'file_id' => 'nullable|image|mime:png,jpg|max:2048'
        ];
    }
}
