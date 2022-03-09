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
        $subSubCategories = SubSubCategory::latest()->get();
        return view('backend.category.subSubCategory', compact('categories','subSubCategories'));
    }

    //Grave Sub Category Based on Category
    function grave($categoryId){
        $subSubCategory = SubCategory::where('category_id', $categoryId)->orderBy('sub_category_name_en', 'ASC')->get();
        return json_encode($subSubCategory);
    }
 /*  
    //Add sub category
    function store(Request $req){
        
        $fields = $req->validate([
            'category_select' => 'required',
            'sub_category_name_en' => 'required|string|min:3|max:25|unique:subcategories,sub_category_name_en',
            'sub_category_name_ban' => 'required|string|unique:subcategories,sub_category_name_ban'
        ], [
            'category_select.required' => 'Please Select Any Option',
            'sub_category_name_en.required' => 'Enter Sub Category Name in English',
            'sub_category_name_ban.required' => 'Enter Sub Category Name in Bengali'
        ]);

        SubCategory::create([
            'category_id' => $fields['category_select'],
            'sub_category_name_en' => $fields['sub_category_name_en'],
            'sub_category_name_ban' => $fields['sub_category_name_ban'],
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', $fields['sub_category_name_en'])),
            'sub_category_slug_ban' => strtolower(str_replace(' ', '-', $fields['sub_category_name_ban'])),
        ]);


        $response = [
            'status' => 201,
            'msg' => 'New SubCategory Added',
            'redirect_uri' => route('all.subCategories'),
        ];

        return response()->json($response);
        
    }

    
    //Edit Sub Category
    function edit($id){
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategory = SubCategory::findOrFail($id);
        return view('backend.category.subCategoryEdit', compact('subCategory', 'categories'));
    }

    //Update Sub Category
    function update(Request $req){
        $fields = $req->validate([
            'category_select' => 'required',
            'sub_category_name_en' => 'required|string|min:3|max:20',
            'sub_category_name_ban' => 'required|string|min:3|max:25',
        ], [
                'category_select.required' => 'Please Select Any Option',
                'sub_category_name_en.required' => 'Enter Sub Category Name in English',
                'sub_category_name_ban.required' => 'Enter Sub Category Name in Bengali'
        ]);

        $subCategory = $req->sub_category_id;

        //dd($category);

        SubCategory::findOrFail($subCategory)->update([
            'category_id' => $fields['category_select'],
            'sub_category_name_en' => $fields['sub_category_name_en'],
            'sub_category_name_ban' => $fields['sub_category_name_ban'],
            'sub_category_slug_en' => strtolower(str_replace(' ', '-', $fields['sub_category_name_en'])),
            'sub_category_slug_ban' => strtolower(str_replace(' ', '-', $fields['sub_category_name_ban'])),
        ]);

        $response = [
            'status' => 201,
            'msg' => 'Sub Category updated successfully',
            'redirect_uri' => route('all.subCategories')
        ];

        return response()->json($response);
    }
    

    //Remove Category
    function remove($id){
        SubCategory::findOrFail($id)->delete();

        $response = [
            'status' => 201,
            'title' => 'Successfully Deleted'
        ];
        return redirect()->back()->with($response);
    } 
 */   
}
