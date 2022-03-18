<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function addProduct(){
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.productAdd', compact('categories', 'brands'));
    }

    public function store(Request $req){
        $fields = $req->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'required',

            'product_name_en' => 'required|string|min:3|max:50|unique:products,product_name_en',
            'product_name_ban' => 'required|string|min:3|max:50|unique:products,product_name_ban',

            'product_code' => 'required|string|min:3|unique:products,product_code',
            'product_qty' => 'required|numeric|min:1',

            'product_tag_en' => 'required|string',
            'product_tag_ban' => 'required|string',

            'product_size_en' => 'required',
            'product_size_ban' => 'required',

            'product_color_en' => 'required|string',
            'product_color_ban' => 'required|string',

            'selling_price' => 'required|numeric|min:1',
            'discount_price' => 'nullable|numeric|min:1',

            'product_thumbnail' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'multi_img.*' => 'image|mimes:jpeg,jpg,png',

            'short_des_en' => 'required|string|max:50',
            'short_des_ban' => 'required|string|max:50',

            'long_des_en' => 'nullable|string|min:20|max:500',
            'long_des_ban' => 'nullable|string|min:20|max:500',

        ]);

        $image = $req->file('product_thumbnail');
        //dd($image);
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1000)->save('upload/products/thumbnail/'.$imageName);
        $save_url = 'upload/products/thumbnail/'.$imageName;
 
        //Add data to the product table
        $ProductId = Product::insertGetId([
            'brand_id' => $fields['brand_id'],
            'category_id' => $fields['category_id'],
            'subcategory_id' => $fields['subcategory_id'],
            'subsubcategory_id' => $fields['subsubcategory_id'],

            'product_name_en' => $fields['product_name_en'],
            'product_name_ban' => $fields['product_name_ban'],
            'product_slug_en' => strtolower(str_replace('','-', $fields['product_name_en'])),
            'product_slug-ban' => strtolower(str_replace('', '-', $fields['product_name_ban'])),

            'product_code' => $fields['product_code'],
            'product_qty' => $fields['product_qty'],

            'product_tag_en' => $fields['product_tag_en'],
            'product_tag_ban' => $fields['product_tag_ban'],

            'product_size_en' => $fields['product_size_en'],
            'product_size_ban' => $fields['product_size_ban'],

            'product_color_en' => $fields['product_color_en'],
            'product_color_ban' => $fields['product_color_ban'],

            'selling_price' =>  $fields['selling_price'],
            'discount_price' => $fields['discount_price'],

            'product_thumbnail' => $save_url,

            'short_des_en' => $fields['short_des_en'],
            'short_des_ban' => $fields['short_des_ban'],
            'long_des_en' => $fields['long_des_en'],
            'long_des_ban' => $fields['long_des_ban'],

            'hot_deals' => $req->hot_deals,
            'featured' => $req->featured,

            'special_offer' => $req->special_offer,
            'special_deals' => $req->special_deals,

            'status' => 1,

            'created_at' => Carbon::now(),

        ]);

        //Multiple image uploads
        $images = $req->file('multi_img');
        foreach($images as $element){
            $nameGenrate = hexdec(uniqid()).'.'.$element->getClientOriginalExtension();
            Image::make($element)->resize(900,1000)->save('upload/products/multiImg/'.$nameGenrate);
            $savePath = 'upload/products/multiImg/'.$nameGenrate;

            MultiImage::insert([
                'product_id' => $ProductId,
                 'image_name' => $savePath,
                 'created_at' => Carbon::now()
             ]);

        }
            

        $response = [
            'status' => 201,
            'msg' => 'Product added successfully',
        ];

        return response()->json($response);
        
    }
}
