<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    //Brand view page
    public function showBrand(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand', compact('brands'));
    }

    //Add Brand
    function store(Request $req){
        $fields = $req->validate([
            'brand_name_en' => 'required|string|min:3|max:20',
            'brand_name_ban' => 'required|string|min:3|max:25',
            'brand_image' => 'required|image|mimes:png,jpg|max:2048'

        ], [
            'brand_name_en' => 'Input Brand Name in English',
            'brand_name_ban' => 'Input Brand Name in Bengali',
        ]);

        $image = $fields['brand_image']; 
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$imageName);
        $save_url = 'upload/brand/'.$imageName;

        Brand::create([
            'brand_name_en' => $fields['brand_name_en'],
            'brand_name_ban' => $fields['brand_name_ban'],
            'brand_slug_en' => strtolower(str_replace(' ', '-', $fields['brand_name_en'])),
            'brand_slug_ban' => strtolower(str_replace(' ', '-', $fields['brand_name_ban'])),
            'brand_image' => $save_url
        ]);


        $response = [
            'status' => 201,
            'msg' => 'Brand added successfully',
        ];

        return response()->json($response);
        
    }

    //Edit Brand
    function edit($id){
        //dd(request());
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
    }
}
