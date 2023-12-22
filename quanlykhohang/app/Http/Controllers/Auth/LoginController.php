<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


   public function dashboard()
   {
       return view('backend.index');
   }
   public function login(Request $request)
   {
       $credentials = $request->only('username', 'password');
       // print_r($credentials);
       if (Auth::attempt($credentials)) {
        return redirect()->route('dashboard.index');
       }
       // Nếu đăng nhập thất bại, quay lại trang đăng nhập
       Session::put("message", "Tên Tài Khoản Hoặc Mật Khẩu Không Đúng❗");
       return redirect()->back()->withInput($request->only('ten_dn'));
   }
}