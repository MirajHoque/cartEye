<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    //slider view
    function showSlider(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider', compact('sliders'));
    }
    
    //Add Slider
    function store(Request $req){
        $fields = $req->validate([
            'slider' => 'required|image|mimes:png,jpg,jpeg'
        ],[
            'slider.required' => 'Select an Image'
        ]);

        $image = $req->file('slider');
        $nameGenerate = hexdec(uniqid().'.'.$image->getClientOriginalExtension());
        Image::make($image)->resize(870,370)->save('upload/slider/'.$nameGenerate);
        $save_url = 'upload/slider/'.$nameGenerate;

        Slider::create([
            'slider' => $save_url,
            'title' => $req->title,
            'description' => $req->description,
        ]);


        $response = [
            'status' => 201,
            'msg' => 'Slider inserted successfully',
            'redirect_uri' => route('manage.slider')
        ];

        return response()->json($response);
    }
}
