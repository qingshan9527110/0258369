<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27 0027
 * Time: 11:25
 */

namespace App\Http\Models;


use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CookStyle extends Model
{
    protected $table = 'cook_style';

    public function store($data)
    {
        return DB::table('cook_style')
            ->insertGetId([
                'name'      => $data['name'],
                'pid'       => $data['pid'],
                'status'    => $data['status'],
                'order'     => $data['order'],
                'created_at' => date('Y-m-d H:m:s',time()),
                'updated_at' => date('Y-m-d H:m:s',time())
            ]);
    }


    public function getTreeList()
    {
        $data = DB::table('cook_style')
            ->select('id','name','pid','status')
            ->get()
            ->map(function ($value) {
                return (array)$value;
            })
            ->toArray();
        return $data;
    }

    public function changeStatus($id)
    {
        $data = DB::table('cook_style')
            ->where('id',$id)
            ->first();
        $status = 0;
        if($data->status == 0)
        {
            $status = 1;
        }
        $res = DB::table('cook_style')
            ->where('id',$id)
            ->update([
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s',time())
            ]);
        return $res;
    }

    public function edit($id,$data)
    {
        return DB::table('cook_style')
            ->where('id',$id)
            ->update([
                'name' => $data['name'],
                'pid' => $data['pid'],
                'order' => $data['order'],
                'status' => $data['status'],
                'updated_at' => date('Y-m-d H:i:s',time())
            ]);
    }

    public function hasChilren($id)
    {
        $data = DB::table('cook_style')
            ->where('id',$id)
            ->first();
        $list_all = DB::table('cook_style')
            ->select('id','name','pid','status')
            ->get()
            ->map(function ($value) {
                return (array)$value;
            })
            ->toArray();
        $list = getTreeGirsCookStyleList($list_all,$data->id);
        $is = false;
        if(count($list)>0)
        {
            foreach ($list as $k=>$v)
            {
                if(array_key_exists('children',$v))
                {
                    $is = true;
                }
            }
        }

        return $is;
    }

    public function del($id)
    {
        if($this->hasChilren($id))
        {
            return 1;
        }else{
            $res = DB::table('cook_style')
                ->where('id',$id)
                ->delete();
            if($res)
            {
                return 0;
            }else{
                return 2;
            }
        }
    }
}
