<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        
        return view('frontend.index', 
        compact('categories', 'sliders', 'products', 'featuredProducts',
                'hotDealProducts', 'specialOfferProducts', 'specialDealProducts'
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
