<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            
        ]);

        $validateData['password']= Hash::make($validateData['password']);

        User::create($validateData);

        return back()->with('berhasil', 'Register Berhasil!');
    }
    public function login_login(Request $request)
    {
        return view('login');
    }
    public function login(Request $request){

        $validateData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($validateData)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
            return redirect()->back()->with('failed','you gagal login');


    //    $user=$request->only(['username','password']);
    //    if (Auth::attempt($user)){
    //      return redirect('/dashboard')->with('islogin','kamu sudah login');
    //     } 
    //    else{
    //          return redirect()->back()->with('failed','you gagal login');
    //     }
    }

}
