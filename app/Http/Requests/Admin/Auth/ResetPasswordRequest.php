<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        'password' => [
          'required',
          'min:6',
          'confirmed'
        ],
        'password_confirmation' => [
          'required',
        ],
      ];
    }
    public function messages()
    {
        return [
          'password_confirmation.required' => 'confirm password field is required.',
          'password.confirmed' => 'confirm password does not match.',
        ];
    }
}
