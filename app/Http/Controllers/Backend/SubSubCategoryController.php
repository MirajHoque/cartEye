<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubSubCategory;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    function showSubSubCategory(){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        //dd($categories);
        $subSubCategories = SubSubCategory::latest()->get();
        //dd($subSubCategories);
        return view('backend.category.subSubCategory', compact('categories','subSubCategories'));
    }

    //Grave Sub Category Based on Category
    function grave($categoryId){
        $subSubCategory = SubCategory::where('category_id', $categoryId)->orderBy('sub_category_name_en', 'ASC')->get();
        return json_encode($subSubCategory);
    }
  
    //Add sub SubCategory
    function store(Request $req){
        
        $fields = $req->validate([
            'category_select' => 'required',
            'sub_category_select' =>'required',
            'sub_sub_category_name_en' => 'required|string|min:3|max:25|unique:subsubcategories,sub_sub_category_name_en',
            'sub_sub_category_name_ban' => 'required|string|min:3|max:30|unique:subsubcategories,sub_sub_category_name_ban'
        ], [
            'category_select.required' => 'Please Select Any Option',
            'sub_category_select.required' => 'Please Select Any Option',
            'sub_sub_category_name_en.required' => 'Enter Sub SubCategory Name in English',
            'sub_sub_category_name_ban.required' => 'Enter Sub SubCategory Name in Bengali'
        ]);

        
        SubSubCategory::create([
            'category_id' => $fields['category_select'],
            'sub_category_id' => $fields['sub_category_select'],
            'sub_sub_category_name_en' => $fields['sub_sub_category_name_en'],
            'sub_sub_category_name_ban' => $fields['sub_sub_category_name_ban'],
            'sub_sub_category_slug_en' => strtolower(str_replace(' ', '-', $fields['sub_sub_category_name_en'])),
            'sub_sub_category_slug_ban' => strtolower(str_replace(' ', '-', $fields['sub_sub_category_name_ban'])),
        ]);


        $response = [
            'status' => 201,
            'msg' => 'New Sub SubCategory Added',
            'redirect_uri' => route('all.subSubCategories'),
        ];

        return response()->json($response);
      
    }
 
    //Edit Sub SubCategory
    function edit($id){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::orderBy('sub_category_name_en', 'ASC')->get();
        $subSubCategory = SubSubCategory::findOrFail($id);
        return view('backend.category.subSubCategoryEdit', compact('categories', 'subCategories', 'subSubCategory'));
    }

    //Update Sub Category
    function update(Request $req){
        $fields = $req->validate([
            'category_select' => 'required',
            'sub_category_select' =>'required',
            'sub_sub_category_name_en' => 'required|string|min:3|max:25',
            'sub_sub_category_name_ban' => 'required|string|min:3|max:30'
        ], [
            'category_select.required' => 'Please Select Any Option',
            'sub_category_select.required' => 'Please Select Any Option',
            'sub_sub_category_name_en.required' => 'Enter Sub SubCategory Name in English',
            'sub_sub_category_name_ban.required' => 'Enter Sub SubCategory Name in Bengali'
        ]);

        $subSubCategoryId = $req->id;

        //dd($category);

        SubSubCategory::findOrFail($subSubCategoryId)->update([
            'category_id' => $fields['category_select'],
            'sub_category_id' => $fields['sub_category_select'],
            'sub_sub_category_name_en' => $fields['sub_sub_category_name_en'],
            'sub_sub_category_name_ban' => $fields['sub_sub_category_name_ban'],
            'sub_sub_category_slug_en' => strtolower(str_replace(' ', '-', $fields['sub_sub_category_name_en'])),
            'sub_sub_category_slug_ban' => strtolower(str_replace(' ', '-', $fields['sub_sub_category_name_ban'])),
        ]);

        $response = [
            'status' => 201,
            'msg' => 'Sub SubCategory updated successfully',
            'redirect_uri' => route('all.subSubCategories')
        ];

        return response()->json($response);
        
    }
    

    //Remove Sub SubCategory
    function remove($id){
        SubSubCategory::findOrFail($id)->delete();

        $response = [
            'status' => 201,
            'title' => 'Successfully Deleted'
        ];
        return redirect()->back()->with($response);
    } 
   
}
