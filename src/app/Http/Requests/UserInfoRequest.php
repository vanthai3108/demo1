<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [ 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->id],
            'avatar' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ];
    }
}
