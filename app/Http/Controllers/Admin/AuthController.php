<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        $checkUserByEmail = User::where('email', $email)->take(1)->first();
        dd($checkUserByEmail);
        if ($checkUserByEmail && Hash::check($request->password, $checkUserByEmail->password)) {
            Auth::login($checkUserByEmail);
            return redirect()->route('admin.index');
        } else {
            Session::flash('error_email', 'Đăng nhập không thành công');
            return redirect()->back();
        }
    }
}
