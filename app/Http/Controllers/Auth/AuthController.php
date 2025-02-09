<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if(User::where('email', $request->email)->first()){
            if(Auth::attempt($request->only('email','password'))){
                return redirect()->route('index')->with('success', 'Login Successfully');
            }else{
                return redirect()->back()->with('danger', 'Login Failed');
            }
        }else{
                return redirect()->back()->with('danger','Email not found!');
            }
            
    
    }
    public function register()
    {
        return view('auth.register');
    }

    public function postregister(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if the email already exists in the database
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->withInput()->with('error', 'The email address is already registered.');
        }

        // Handle the image upload
        $file = $request->file('image');
        $file_name = uniqid() . '_' . $file->getClientOriginalName();
        $file_path = $file->storeAs('image', $file_name);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_path,
        ]);

        // Redirect to the login page with a success message
        return redirect()->route('showlogin')->with('success', 'Welcome'.$user->name.'.Please Login');
    }


    public function logout()
    {
        Auth::logout();
        return redirect(route('showlogin'));
    }
}
