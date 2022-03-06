<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function store(Request $req){
        $fields = $req->validate([
            'name' => 'required|string|min:5|max:30',
            'email' => 'required|email',
            'phone' => 'required|string|min:5|max:11',
            'profile_photo' => 'image|mimes:png,jpg|max:2048'

        ]);

        $data = User::find(Auth::user()->id);

        $data->name = $fields['name'];
        $data->email = $fields['email'];
        $data->phone = $fields['phone'];
        
        //check if admin upload a image
        if($req->hasFile('profile_photo')){
            $file = $req->file('profile_photo');
            @unlink(public_path('upload/adminImages/'.$data->profile_photo_path));
            //$extension = getClientOrginalExtension($file);
            $fileName = date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/userImages'), $fileName);
            $data->profile_photo_path = $fileName;
        }

        $data->save();

        $response = [
            'status' => 201,
            'msg' => 'Profile updated successfully',
            'redirect_uri' => route('dashboard')
        ];

        return response()->json($response);
    }

    function changePassword(){
        $user = User::find(Auth::user()->id);
        return view('frontend.profile.changePassword', compact('user'));
    }

    function updatePassword(Request $req){
        $fields = $req->validate([
             'currentPassword' => 'required|min:8|max:30',
             'newPassword' => 'required|min:8|max:30',
             'confirmPassword' => 'required|min:8|max:30|same:newPassword',
         ]);
 
         //dd($fields['confirm_password']);
 
         $hashedPassword = Auth::user()->password;
         //dd($hashedPassword);
        if(Hash::check($fields['currentPassword'], $hashedPassword)){
             $data = User::find(Auth::user()->id);
             $data->password = bcrypt($fields['newPassword']) ;
             $data->save();
            // dd($data);
             Auth::guard('web')->logout();
             //return redirect()->route('user.logout');
 
             $response = [
                 'status' => 201,
                 'msg' => 'Password updated successfully',
                 'redirect_uri' => route('admin.login')
             ];
 
             return response()->json($response);
         
             
         }
        else{
             return redirect()->back();
         }
     }     
}
