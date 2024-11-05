<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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
            'full_name' => [
              'required',
              'min:3',
              'max:40',
            ],
            'country_code' => [
              'required',
            ],
            'contact_number' => [
              'required',
              'numeric',
              'digits_between:8,10',
              Rule::unique('users')->where(function($query) {
                $query->where('is_deleted',0);
              })->ignore($this->id)
            ],
            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png',
                'dimensions:min_width=250,min_height=250',
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
            'profile_image.mimes' => 'admin image must be an image.',
            'profile_image.dimensions' => 'admin image has invalid image dimensions.'
        ];
    }
}
