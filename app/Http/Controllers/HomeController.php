<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Setting;
use Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Chat;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('register','home','login','regesteruser');
    }
    public function image_show($filename = null)
    {
        return Image::make(storage_path('app/public/' . $filename))->response();
    }
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        $setting=Setting::first();
        // return auth()->user()->hasPermission('setting-index');
        // return auth()->user()->with('roles.permissions')->first();
        return view('dashboard.layouts.app',compact('setting'));
    }
   
    
    public function search(Request $request)
    {
        $users  = User::where('name', 'LIKE', '%'. $request->s. '%')->where('id', '!=', auth()->id())->get();
        return view('site.search', compact('users'));
    }
    
    public function home()
    {
        return view('site.home');
    }
  
   
    public function messages()
    {
        return view('site.message');
    }
    public function start_chat(Request $request) {
        $request->validate([
            'id' => 'required|exists:users,id'
        ]);
        $chat       = Chat::where('starter_id', auth()->id())->where('user_id', $request->id)->first();

        if(!$chat) {
            $chat                   = new Chat;
            $chat->starter_id       = auth()->id();
            $chat->user_id          = $request->id;
            $chat->save();
        }

        return response()->json(['message' => 'success']);

    }
    public function chat(Request $request) {
        $chats =  Chat::where('starter_id', auth()->id())->orWhere('user_id', auth()->id())->latest()->get();
        return view('site.message', compact('chats'));
    }
}
