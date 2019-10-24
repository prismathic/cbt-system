<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    // use AuthenticatesUsers;

    // protected $guard = 'admins';

    public function __construct()
    {
        $this->middleware('guest:admins')->except('logout');
    }

    public function showLoginForm() {
        return view('admin.login')->with('error', array());
    }

    // protected function guard()
    // {
    //     return Auth::guard($this->guard);
    // }



    public function authenticate(Request $request) {
        $credentials = $request->only('username','password');

        if(Auth::guard('admins')->check($credentials)) {
            return redirect()->intended(route('dashboard'));
        }

        return view('admin.login')->with('error', $credentials);
    }

    public function logout() {
        Auth::guard('admins')->logout();
        return redirect('/admin/login');
    }
}