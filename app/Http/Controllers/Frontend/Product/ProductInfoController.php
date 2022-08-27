<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductInfoController extends Controller
{
    //product details
    public function productDetails($id, $slug){
        $product = Product::findOrFail($id);
        $multiImages = MultiImage::with('product')->where('product_id', '=', $id)->get();

        return view('frontend.product.product-details', compact('product', 'multiImages'));
    }
}
