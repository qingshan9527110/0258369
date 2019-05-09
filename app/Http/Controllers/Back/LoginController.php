<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29 0029
 * Time: 18:24
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/back';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function username()
    {
        return 'account';
    }

    public function showLoginForm()
    {
        return view('back.admin.login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    // 退出后跳转页面
    protected function loggedOut(Request $request)
    {
        return redirect(route('back.admin.login'));
    }
}
