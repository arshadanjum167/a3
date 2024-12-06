<?php

namespace App\Http\Requests\Admin\Casestudy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the emailtemplate is authorized to make this request.
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
            'title' => [
              'required',
            //   'min:2',
              'max:255',
            ],
            // 'content' => [
            //     'required',
            // ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title field is required.',
            'title.min' => 'Title must be at least 2 characters.',
            // 'content.required' => 'email content field is required.',
        ];
    }
}
