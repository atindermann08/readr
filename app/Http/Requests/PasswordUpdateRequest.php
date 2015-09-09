<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PasswordUpdateRequest extends Request
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
            'current_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_new_password' => 'required|same:new_password',
        ];
    }
}
