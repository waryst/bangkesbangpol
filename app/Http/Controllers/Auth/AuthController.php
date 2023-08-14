<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check() and auth()->user()->role == 'administrator') {
            return to_route('dashboard');
        }
        else if (Auth::check() and auth()->user()->role == 'operator') {
            return to_route('home');
        } else {
            return view('login.index');
        }
    }
    public function changePassword()
    {

    }
    public function postlogin(Request $request)
    {
        
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['email' => $username, 'password' => $password])) {

            if (auth()->user()->role == 'administrator'){
                return to_route('dashboard');
            }
            elseif (auth()->user()->role == 'operator'){
                return to_route('home');
            }


        } else {
            return redirect()->route('login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
