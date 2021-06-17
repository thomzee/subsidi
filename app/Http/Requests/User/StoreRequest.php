<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|min:2|max:50',
            'role' => 'required',
            'username' => 'required|min:3|max:50|unique:users,username,NULL,id,deleted_at,NULL',
            'password' => 'required|min:6|max:20|confirmed',
        ];
    }
}
