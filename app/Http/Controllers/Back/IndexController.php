<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19 0019
 * Time: 17:07
 */

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:admin');
    }

    public function index()
    {
        return view('back/index/index');
    }

    public function info(Request $request)
    {
        $user = DB::table('users')->get();
        dd($user);
    }

    public function welcome()
    {
        return view('back/index/welcome');
    }
}
