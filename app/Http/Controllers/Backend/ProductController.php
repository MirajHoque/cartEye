<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
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
            'subsubcategory_id' => 'nullable',

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

            'short_des_en' => 'required|string|max:1000',
            'short_des_ban' => 'required|string|max:1000',

            'long_des_en' => 'nullable',
            'long_des_ban' => 'nullable',

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
            'subsubcategory_id' => $fields['subsubcategory_id'] ?? 0,

            'product_name_en' => $fields['product_name_en'],
            'product_name_ban' => $fields['product_name_ban'],
            'product_slug_en' => strtolower(str_replace('','-', $fields['product_name_en'])),
            'product_slug_ban' => strtolower(str_replace('', '-', $fields['product_name_ban'])),

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
            'redirect_uri' => route('manage.product')
        ];

        return response()->json($response);
        
    }

    //Product Manage page
    public function manage(){
        $products = Product::latest()->get();
        return view('backend.product.products', compact('products'));
    }

    //Product Edit Page
    function edit($id){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubCategories = SubSubCategory::latest()->get();

        $multiImages = MultiImage::where('product_id', '=', $id)->get();

        $product = Product::findOrFail($id);

        return view('backend.product.productEdit', compact('brands', 'categories', 'subCategories', 'subSubCategories', 'product', 'multiImages'));
    }

    //product update
    function update(Request $req){
        $productId = $req->id;

        $fields = $req->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_id' => 'nullable',

            'product_name_en' => 'required|string|min:3|max:50',
            'product_name_ban' => 'required|string|min:3|max:50',

            'product_code' => 'required|string|min:3',
            'product_qty' => 'required|numeric|min:1',

            'product_tag_en' => 'required|string',
            'product_tag_ban' => 'required|string',

            'product_size_en' => 'required',
            'product_size_ban' => 'required',

            'product_color_en' => 'required|string',
            'product_color_ban' => 'required|string',

            'selling_price' => 'required|numeric|min:1',
            'discount_price' => 'nullable|numeric|min:1',

            'short_des_en' => 'required|string|max:1000',
            'short_des_ban' => 'required|string|max:1000',

            'long_des_en' => 'nullable',
            'long_des_ban' => 'nullable',

        ]);

        //update data to the product table
        $ProductId = Product::findOrFail($productId)->update([
            'brand_id' => $fields['brand_id'],
            'category_id' => $fields['category_id'],
            'subcategory_id' => $fields['subcategory_id'],
            'subsubcategory_id' => $fields['subsubcategory_id'] ?? 0,

            'product_name_en' => $fields['product_name_en'],
            'product_name_ban' => $fields['product_name_ban'],
            'product_slug_en' => strtolower(str_replace('','-', $fields['product_name_en'])),
            'product_slug_ban' => strtolower(str_replace('', '-', $fields['product_name_ban'])),

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

        $response = [
            'status' => 201,
            'msg' => 'Product updated successfully without image',
            'redirect_uri' => route('manage.product')
        ];

        return response()->json($response);
        

    }

    //update product multi image
    function imageUpdate(Request $req){
        $req->validate([
            'multi_img.*' => 'image|mimes:png,jpg,jpeg',
        ]);

        $images = $req->multi_img;
        //dd($images);

        foreach($images as $key => $value){
            $imageDelete = MultiImage::findOrFail($key);
            unlink($imageDelete->image_name);

            $nameGenrate = hexdec(uniqid()).'.'.$value->getClientOriginalExtension();
            Image::make($value)->resize(900,1000)->save('upload/products/multiImg/'.$nameGenrate);
            $savePath = 'upload/products/multiImg/'.$nameGenrate;

            MultiImage::where('id', '=', $key)->update([
                 'image_name' => $savePath,
                 'updated_at' => Carbon::now()
             ]);

             $response = [
                'status' => 201,
                'msg' => 'Product Image successfully updated',
                'redirect_uri' => route('manage.product')
            ];
            
        return response()->json($response);

        }
    }

    //Thumbnail Update
    function thumbnailUpdate(Request $req){
        $req->validate([
            'product_thumbnail' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $productId = $req->id;
        $oldThumbnail = $req->old_thumbnail;

        unlink($oldThumbnail);

        $image = $req->file('product_thumbnail');
        //dd($image);
        $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900,1000)->save('upload/products/thumbnail/'.$imageName);
        $save_url = 'upload/products/thumbnail/'.$imageName;

        Product::findOrFail($productId)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now()
        ]);

        $response = [
            'status' => 201,
            'msg' => 'Product Thumbnail Updated successfully',
            'redirect_uri' => route('manage.product')
        ];

        return response()->json($response);
    }

    //Multiple Image delete
    function MultiImgDelete($id){
        $oldImage = MultiImage::findOrFail($id);
        unlink($oldImage->image_name);
        MultiImage::findOrFail($id)->delete();

        return redirect()->back();
    }

    //product Inactive
    function inActive($id){
        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        return redirect()->back();
    }

    //product Active
    function active($id){
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        return redirect()->back();

    }

    //product delete
    function delete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $multiImages = MultiImage::where('product_id', '=', $id)->get();
        foreach($multiImages as $element){
            unlink($element->image_name);
            MultiImage::where('product_id', '=', $id)->delete();
        }

        return redirect()->back();

    }

}
