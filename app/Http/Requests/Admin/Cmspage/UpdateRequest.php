<?php

namespace App\Http\Requests\Admin\Cmspage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'description' => [
                'required',
            ],
            'name' => [
                'required',
                'max:255',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'CMS page name field is required.',
            'name.max' => 'CMS page name may not be greater than 255 characters.',
            'description.required' => 'Content field is required.',
        ];
    }
}
