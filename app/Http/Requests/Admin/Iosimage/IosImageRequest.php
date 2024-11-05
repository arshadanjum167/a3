<?php

namespace App\Http\Requests\Admin\Iosimage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IosImageRequest extends FormRequest
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
            
            'ios_image' => [
                'required',
                'image',
                'mimes:jpeg,jpg,png'
            ],
        ];
    }

    public function messages()
    {
        return [
            'contact_number.required' => 'mobile number field is required.',
            'contact_number.numeric' => 'mobile number must be a number.',
            'contact_number.digits_between' => 'mobile number must be between 8 and 10 digits.',
            'contact_number.unique' => 'mobile number has already been taken.',
            'ios_image.mimes' => 'image must be an image.',
            'ios_image.dimensions' => 'admin image has invalid image dimensions.'
        ];
    }
}
