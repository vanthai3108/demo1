<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:30', 'unique:users,username,'.$this->user->id],
            'email' => [ 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
            'password' => ['required', 'string', 'min:8'],
            'avatar' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            'roles' => ['required'],
        ];
    }
}
