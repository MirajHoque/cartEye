<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    //admin profile
    function adminProifle(){
        $adminData = Admin::findOrFail(1);
        return view('admin.adminProile', compact('adminData'));
    }

    //admin profile edit page
    function adminProifleEdit(){
        $editData = Admin::findOrFail(1);
        return view('admin.adminProileEdit', compact('editData'));
    }

    //update admin profile
    public function store(Request $req){
       
        $fields = $req->validate([
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email',
            'profile_photo' => 'image|mimes:png,jpg|max:2048'

        ]);

        $data = Admin::find(1);

        $data->name = $fields['name'];
        $data->email = $fields['email'];
        
        //check if admin upload a image
        if($req->hasFile('profile_photo')){
            $file = $req->file('profile_photo');
            @unlink(public_path('upload/adminImages/'.$data->profile_photo_path));
            //$extension = getClientOrginalExtension($file);
            $fileName = date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/adminImages'), $fileName);
            $data->profile_photo_path = $fileName;
        }

        $data->save();

        $response = [
            'status' => 201,
            'msg' => 'Profile updated successfully',
            'redirect_uri' => route('admin.profile')
        ];

        return response()->json($response);
    }

    //Password change view
    function changePassword(){
        return view('admin.adminChangePassword');
    }

    //Password update
    function updatePassword(Request $req){
       $fields = $req->validate([
            'currentPassword' => 'required|min:8|max:30',
            'newPassword' => 'required|min:8|max:30',
            'confirmPassword' => 'required|min:8|max:30|same:newPassword',
        ]);

        //dd($fields['confirm_password']);

        $hashedPassword = Admin::find(1)->password;
        //dd($hashedPassword);
       if(Hash::check($fields['currentPassword'], $hashedPassword)){
            $data = Admin::find(1);
            $data->password = bcrypt($fields['newPassword']) ;
            $data->save();
           // dd($data);
            Auth::guard('admin')->logout();
            //return redirect()->route('admin.logout');

            $response = [
                'status' => 201,
                'msg' => 'Password updated successfully',
                'redirect_uri' => route('admin.login')
            ];

            return response()->json($response);
        
            
        }
       // else{
         //   return redirect()->back();
        //}
    }    
    
}

