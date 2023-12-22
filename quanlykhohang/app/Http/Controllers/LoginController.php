<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        // print_r($credentials);
        if (Auth::attempt($credentials)) {
            //lưu ngày giờ đăng nhập
            // $user=Auth::user();
            // $user->last_login_at=now();
            // $user->save();
            // Nếu đăng nhập thành công, chuyển hướng đến trang quản lý của admin
            // $this->middleware('admin');
            return redirect()->action([AdminController::class, 'dashboard']);
        }
        // Nếu đăng nhập thất bại, quay lại trang đăng nhập
        Session::put("message", "Tên Tài Khoản Hoặc Mật Khẩu Không Đúng❗");
        return redirect()->back()->withInput($request->only('ten_dn'));
    }
}