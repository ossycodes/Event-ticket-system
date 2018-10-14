<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class updateProfile extends FormRequest
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
            'name' => 'required|string',
            'phonenumber' => 'required|digits:11',
            'gender' => [
                'required',
                Rule::in(['male', 'Male', 'Female', 'female', 'FEMALE', 'MALE']),
             ],
            'education' => 'required|string',
            'location' => 'required|string',
            'skills' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'gender.in' => 'Please the given gender must match either of these: MALE, Male, male, FEMALE, Female, female'
        ];
    }
}
