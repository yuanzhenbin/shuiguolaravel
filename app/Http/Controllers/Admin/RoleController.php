<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\Roleinsert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //管理员列表
        $k = $request->input("keywords");
        $role = DB::table("role")->where("role_name","like","%".$k."%")->paginate(5);
        return view("Admin.Role.index",["role"=>$role,"request"=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加权限跳转
        return view("Admin.Role.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Roleinsert $request)
    {
        //执行添加权限
        $data = $request->except(['_token']);
        if (DB::table("node")->insert($data)) {
            return redirect("/role")->with("success","添加成功");
        }else{
            return back()->with("error","添加失败");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //分配权限
        $role = DB::table("role")->where("id","=",$id)->first();
        $node = DB::table("node")->get();
        $data = DB::table("role_node")->where("rid","=",$id)->get();
        if (count($data)) {
            foreach($data as $v){
                $nids[] = $v->nid;

            }
            return view("Admin.Role.edit",["role"=>$role,"node"=>$node,"nids"=>$nids]);
        }else{
            return view("Admin.Role.edit",["role"=>$role,"node"=>$node,"nids"=>array()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //执行修改权限
        //获取修改角色所需要的uid和rid
        $rid = $id;
        $nid = $request->input("nid");
        //把原角色删除，创建新角色
        DB::table("role_node")->where("rid","=",$rid)->delete();
        foreach($nid as $key=>$v){
            //封装要插入的数据
            $data['rid']=$rid;
            $data['nid']=$v;
            //插入
            DB::table("role_node")->insert($data);
        }       
        //返回管理员列表
        return redirect("/role")->with("success","角色分配成功");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        //角色不能删除
    }
}
