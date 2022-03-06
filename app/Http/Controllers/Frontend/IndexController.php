<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        return view('frontend.index');
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
