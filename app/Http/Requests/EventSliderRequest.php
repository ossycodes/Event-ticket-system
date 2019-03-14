<?php

namespace App\Http\Requests;

use App\Eventsliderimages;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;

class EventSliderRequest extends FormRequest
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
            'image.*' => 'required|mimes:jpeg,jpg,png,PNG'
        ];
    }

    public function uploadSliderImages() {
        
        if ($this->hasFile('image')) {

            $files = $this->file('image');

            foreach ($files as $file) {
                //upload images after resize
                $image = new Eventsliderimages;
                $extension = $file->getClientOriginalExtension();
                $date = date('Ymdhis');
                $fileName = rand(111, 999) . $date . '.' . $extension;
                $path = 'images/frontend_images/eventsliderimages/' . $fileName;

                //resize images
                Image::make($file)->save($path);

                $image->slider_imagename = $fileName;
                //save image to database
                try {
                    $image->save();
                } catch (\Exception $e) {
                    return false;
                }

            }
        }
        return $this;
    }
}
