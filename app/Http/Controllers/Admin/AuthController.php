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
    public function getRegister()
    {
        return view('admin.auth.register');
    }

    public function postRegister(Request $request)
    {
        // Kiểm tra dữ liệu vào
        $allRequest  = $request->all();
        $validator = $this->validator($allRequest);

        if ($validator->fails()) {
            // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
            return redirect('register')->withErrors($validator)->withInput();
        } else {
            // Dữ liệu vào hợp lệ sẽ thực hiện tạo người dùng dưới csdl
            if ($this->create($allRequest)) {
                // Insert thành công sẽ hiển thị thông báo
                Session::flash('success', 'Đăng ký thành viên thành công!');
                return redirect('register');
            } else {
                // Insert thất bại sẽ hiển thị thông báo lỗi
                Session::flash('error', 'Đăng ký thành viên thất bại!');
                return redirect('register');
            }
        }
    }

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
