<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => ['required', 'unique:courses,name'], 
            'description' => ['required'], 
            'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'], 
            'numberOfSessions' => ['required', 'numeric'], 
            'shift' => ['required', 'numeric'], 
            'startDate' => ['required', 'date'], 
            'endDate' => ['required', 'date'],
            'category_id' => ['numeric'],
        ];
    }
}
