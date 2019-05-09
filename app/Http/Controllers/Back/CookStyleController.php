<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26 0026
 * Time: 18:00
 */

namespace App\Http\Controllers\Back;


use App\Http\Controllers\Controller;
use App\Http\Models\CookStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CookStyleController extends Controller
{
    public function index()
    {
        return view('back.cook_style.index');
    }

    public function create($pid=0)
    {
        $list = CookStyle::all();
        $list = getTreeCookStyleList($list);
        return view('back.cook_style.create')
            ->with([
                'list'=>$list,
                'pid' =>$pid
            ]);
    }

    public function store(Request $request)
    {
        $data['name'] = $request->input('name');
        $data['pid'] = $request->input('pid');
        $data['status'] = $request->input('status');
        $data['order'] = $request->input('order');
        $model = new CookStyle();
        $res = $model->store($data);
        return $res;
    }

    public function edit($id)
    {
        $info = CookStyle::find($id);
        $list = CookStyle::all();
        $list = getTreeCookStyleList($list);
        return view('back/cook_style/edit')
            ->with([
                'info' => $info,
                'list' => $list
            ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $model = new CookStyle();
        $res = $model->edit($id,$data);
        return $res;
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $model = new CookStyle();
        $res = $model->del($id);
        switch ($res)
        {
            case 0 :
                return ['code'=>0,'msg'=>'删除成功'];
                break;
            case 1 :
                return ['code'=>1,'msg'=>'请先删除子分类'];
                break;
            case 2 :
                return ['code'=>2,'msg'=>'删除失败'];
                break;
            default :
                break;
        }

    }

}
