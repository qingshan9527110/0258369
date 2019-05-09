<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/29 0029
 * Time: 18:25
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/back';

    public function index()
    {
        return view('back.admin.index');
    }

    public function del()
    {
        return view('back.admin.del');
    }

}
