<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27 0027
 * Time: 17:50
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Models\CookStyle;
use Illuminate\Http\Request;

class CookStyleController extends Controller
{
    public function getList()
    {
        $model = new CookStyle();
        $list = $model->getTreeList();
        $list = getTreeGirsCookStyleList($list);
        return $list;
    }

    public function status(Request $request)
    {
        $id = $request->post('id');
        $model = new CookStyle();
        $res = $model->changeStatus($id);
        return $res;
    }
}
