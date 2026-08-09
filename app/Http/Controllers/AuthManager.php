<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        return view('auth.login');
    }

    function register(){
        return view('auth.signup');
    }
    function registerPost(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8'
        ]);
        $user= new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            return redirect(route('login'))
            ->with('success','You have registered successfully');
        }
        return redirect(route('register'))
        ->with('error','Registration Failed');
    }

    function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $credentials= $request->only('email','password'); //only get email and password from the request

        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error','Login details are not valid'); //redirect to login page with error message

    }


    function home(){
        return view('notes.home');
    }
}
