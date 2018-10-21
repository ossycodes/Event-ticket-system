<?php

namespace App\Http\Controllers\Admin;

use App\Eventsliderimages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class EventsliderimagesController extends Controller
{

    public function create() {
        return view('admin.eventsimagesliders.create');
    }

    public function store(Request $request) {

        if(Eventsliderimages::count() === 6) {
            return back()->with('error', 'Number of Imagesliders uploaded already at maximum (6)'); 
        }

        Validator::make($request->all(), [
            'image.*' => 'required|mimes:jpeg,jpg,png'
        ])->validate();

        if ($request->hasFile('image')) {
                
            $files = $request->file('image');
            //echo "<pre>";print_r($files);die;
            foreach ($files as $file) {
                //upload images after resize
                $image = new Eventsliderimages;
                $extension = $file->getClientOriginalExtension();
                $date = date('Ymdhis');
                $fileName = rand(111, 999).$date.'.'.$extension;
                $path = 'images/frontend_images/eventsliderimages/'.$fileName;

                //resize images
                Image::make($file)->save($path);

                $image->slider_imagename = $fileName;
                //save image to database
                try{
                    $image->save();
                } catch(\Exception $e) {
                    return back()->with('error', 'Something went wrong');
                }
                

            }
        }

        return back()->with('success', 'Events image siders uploaded successfully');
    }
}
