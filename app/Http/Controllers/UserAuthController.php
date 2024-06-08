<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //admin login form
    public function index(){
        if(Auth::check()){
            return redirect('/');
        } else{
            return view('admin.login');
        }

    }//end method


    //post login
    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);


        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           return redirect('/');
        } else{
            return redirect('/login')->with('message',"Oops! Your credentials don't match our records.Please try again.");
        }
    }//end method


    //admin logout
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }//end method

    //change password form
    public function changePassword(){
        return view('admin.change_pass_form');
    }//end method


    //update password
    public function updatePassword(Request $request){
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/')->with('sms','Password updated successfully.');
    }
}
