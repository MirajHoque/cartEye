<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function showCategory(){
        $categories = Category::latest()->get();
        return view('backend.category.category', compact('categories'));
    }
    
    //Add category
    function store(Request $req){
        
        $fields = $req->validate([
            'category_name_en' => 'required|string|min:3|max:20|unique:categories,category_name_en',
            'category_name_ban' => 'required|string|min:3|max:25|unique:categories,category_name_en',
            'category_icon' => 'required|string|unique:categories,category_name_en'
        ]);

        Category::create([
            'category_name_en' => $fields['category_name_en'],
            'category_name_ban' => $fields['category_name_ban'],
            'category_slug_en' => strtolower(str_replace(' ', '-', $fields['category_name_en'])),
            'category_slug_ban' => strtolower(str_replace(' ', '-', $fields['category_name_ban'])),
            'category_icon' => $fields['category_icon']
        ]);


        $response = [
            'status' => 201,
            'msg' => 'New Category Added',
            'redirect_uri' => route('all.categories')
        ];

        return response()->json($response);
        
    }

    //Edit Category
    function edit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.categoryEdit', compact('category'));
    }

    function update(Request $req){
        $fields = $req->validate([
            'category_name_en' => 'required|string|min:3|max:20',
            'category_name_ban' => 'required|string|min:3|max:25',
            'category_icon' => 'required|string'
        ]);

        $category = $req->category_id;

        //dd($category);

        Category::findOrFail($category)->update([
            'category_name_en' => $fields['category_name_en'],
            'category_name_ban' => $fields['category_name_ban'],
            'category_slug_en' => strtolower(str_replace(' ', '-', $fields['category_name_en'])),
            'category_slug_ban' => strtolower(str_replace(' ', '-', $fields['category_name_ban'])),
            'category_icon' => $fields['category_icon']
        ]);

        $response = [
            'status' => 201,
            'msg' => 'Category updated successfully',
            'redirect_uri' => route('all.categories')
        ];

        return response()->json($response);


    }

    //Remove Category
    function remove($id){
        Category::findOrFail($id)->delete();

        $response = [
            'status' => 201,
            'title' => 'Successfully Deleted'
        ];
        return redirect()->back()->with($response);
    }
    
}
