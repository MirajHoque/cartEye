<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function bengali(){
        session()->get('language');
        //dd('language');
        session()->forget('language');
        session()->put('language', 'Bengali');
        return redirect()->back();
    }

    public function english(){
        session()->get('language');
        session()->forget('language');
        session()->put('language', 'English');
        return redirect()->back();
    }
}
