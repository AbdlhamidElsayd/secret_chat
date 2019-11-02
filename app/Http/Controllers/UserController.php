<?php

namespace App\Http\Controllers;
use App\User;
use App\Setting;
use Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

class UserController extends Controller
{
//login
    public function login(){
        return view('site.login');
    }

//register

    public function regesteruser()
    {
        return view('site.register');

    }
    public function register(Request $request){
        $request->validate([
            'name'     => 'required|string',
            'phone'     => 'required|string',
            'email'     =>'required|string|email|max:255|unique:users' ,
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user               = new User();
        $user->name         = $request->name;
        $user->phone         = $request->phone;
        $user->email        = $request->email;

        if($request->hasFile('image')){
        $image = $request->image;
        $filename  = mt_rand(1000, 10000).time().uniqid().'.'.$image->getClientOriginalExtension();
        $path = storage_path('app/public/' . $filename);
        Image::make($image->getRealPath())->resize(100, 100)->save($path);
        $user->image        =$filename;
        }
        
        $user->password     = bcrypt($request->password);
        $user->save();
        Auth::loginUsingId($user->id);
        return redirect()->route('home');
    }

//change-photo
    public function change_photo(Request $request){
        $request->validate([
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $user               =  User::find(Auth::user()->id);
        if($request->hasFile('image')){
            $image = $request->image;
            $filename  = mt_rand(1000, 10000).time().uniqid().'.'.$image->getClientOriginalExtension();
            $path = storage_path('app/public/' . $filename);
            Image::make($image->getRealPath())->resize(100, 100)->save($path);
            $user->image        =$filename;
            $user->save();
            return redirect()->route('home')->with('success', 'You Are Changing Your Photo Successfully');
        }
        return redirect()->route('home')->with('success', 'You Dont Select Any Photo');      
    }

//change_details
    public function change_details(Request $request){
        $user               =  User::find(Auth::user()->id);
        $request->validate([
            'name'     => 'nullable|string',
            'phone'     => 'nullable|string',
            'email'     =>'nullable|email|unique:users,email,'.$user->id, 
        ]);
        $user->name         = $request->name;
        $user->phone        = $request->phone;
        $user->email        = $request->email;

        $user->save();
        return redirect()->route('home')->with('success', 'You Are Changing Your Details Successfully');
    }
//changePassword
    public function changePassword(Request $request){
        if (!(Hash::check($request->input('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current_password'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }
}
