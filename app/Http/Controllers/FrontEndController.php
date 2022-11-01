<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function login(){
        return view('pages.login');
    }
    public function register(){
        return view('pages.register');
    }
    public function forgetPassword(){
        return view('pages.forget-password');
    }
    public function dashboard(){
        return view('pages.dashboard');
    }
}
