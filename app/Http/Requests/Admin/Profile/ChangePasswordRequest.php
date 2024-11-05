<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        'old_password' => [
          'required',
        ],
        'password' => [
          'required',
          'min:6',
          // 'confirmed'
        ],
        'password_confirmation' => [
          'required',
          'same:password',
        ],
      ];
    }

    public function messages()
    {
      return [
        'password.required' => 'New password field is required.',
        'password.min' => 'New password must be at least 6 characters.',
        'password_confirmation.same' => 'Confirm password and new password must match.',
        'password_confirmation.required' => 'Confirm password field is required.',
      ];
    }
}
