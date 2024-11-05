<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                  $query->where('is_deleted',0)->where('actor',2);
              })->ignore($this->id),
          ],
          'email' => [
            'required',
            'email',
            Rule::unique('users')->where(function($query) {
                  $query->where('is_deleted',0)->where('actor',2);
              })->ignore($this->id),
          ],
          'marina_id' => [
            'required',
          ],
          'slip_number' => [
            'required',
            //'numeric',
          ],
          'years_at_marina' => [
            'required',
            'numeric',
          ],
          // 'vassel_vue_hd_link' => [
          //   'required',
          // ],
          // 'vassel_vue_normal_link' => [
          //   'required',
          // ],
          'password' => [
            'nullable',
            'min:6',
            'max:20',
          ],

      ];
    }
}
