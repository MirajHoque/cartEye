<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::all();
        $sliders = Slider::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('status', '=', '1')->orderBy('id', 'DESC')->limit(6)->get();
        $featuredProducts = Product::where('featured', '=', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotDealProducts = Product::where('hot_deals', '=', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $specialOfferProducts = Product::where('special_offer', '=', 1)->orderBy('id', 'DESC')->limit(5)->get();
        $specialDealProducts = Product::where('special_deals', '=', 1)->orderBy('id', 'DESC')->limit(3)->get();
        
        $specificCategory = Category::skip(0)->first();
        
        $specificCategoryWiseProduct = Product::where([
            ['status', '=', 1],
            ['category_id', '=', $specificCategory->id]
        ])
        ->orderBy('id', 'DESC')
        ->get();

        $specificCategoryTwo = Category::skip(1)->first();
        
        $specificCategoryWiseProductTwo = Product::where([
            ['status', '=', 1],
            ['category_id', '=', $specificCategoryTwo->id]
        ])
        ->orderBy('id', 'DESC')
        ->take(5)
        ->get();

        $specificBrand = Brand::skip(0)->first();
        
        $specificBrandWiseProduct = Product::where([
            ['status', '=', 1],
            ['brand_id', '=', $specificBrand->id]
        ])
        ->orderBy('id', 'DESC')
        ->get();

        $specificBrandTwo = Brand::skip(1)->first();
        
        $specificBrandWiseProductTwo = Product::where([
            ['status', '=', 1],
            ['brand_id', '=', $specificBrandTwo->id]
        ])
        ->orderBy('id', 'DESC')
        ->take(5)
        ->get();

        return view('frontend.index', 
        compact('categories', 'sliders', 'products', 'featuredProducts',
                'hotDealProducts', 'specialOfferProducts', 'specialDealProducts',
                'specificCategory', 'specificCategoryWiseProduct', 'specificCategoryTwo',
                'specificCategoryWiseProductTwo', 'specificBrand', 'specificBrandWiseProduct',
                'specificBrandTwo', 'specificBrandWiseProductTwo'
            ));
    }

    function logOut(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
    function userProfile(){
        $id= Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.userProfile', compact('user'));
    }
}
