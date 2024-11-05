<?php

namespace App\Http\Requests\Admin\Emailtemplate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            // 'min:2',
            'max:255',
          ],
          'content' => [
              'required',
          ],
      ];
    }
}
