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

    public function postLogin(Request $request)
    {
        // dd($request);
        $data = $request->only('email', 'password');
        // dd($data);
        // dd(Hash::make(123456789));
        if (Auth::attempt($data)) {
            return redirect()->route('admin.index');
        } else {
            return false;
        }
    }
}
