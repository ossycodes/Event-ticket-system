<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvent extends FormRequest
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
            //validation rules
            'name' => 'required',
            'category_id' => 'required|integer',
            'image' => 'required|mimes:jpeg,jpg,png',
            'venue' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'actors' =>'nullable|string',
            'age' => 'required|max:90',
            'dresscode' => 'nullable|string',
            'regular' => 'nullable|numeric',
            'vip' => 'nullable|numeric',
            'tableforten' => 'nullable|numeric',
            'tableforhunderd' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
       return [ 
        //custom validation messages.
        'category_id.required' => 'Please select a given category',
        'name.required' => 'Please give the event a name',
        'image.required' => 'Please choose an image for the event',
        'venue.required' => 'Please what is the venue of the event?',
        'description.required' => 'Please give a description of the event',
        'date.required' => 'Please what date is the event?',
        'time.required' => 'Please what time is the event?',
        'age.required' => 'Please what is the age limit?',
       ];
    } 
}
