<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\Admininsert;

class AdminController extends Controller
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
        $user = DB::table("admin")->where("admin_name","like","%".$k."%")->paginate(5);
        return view("Admin.Admin.index",["user"=>$user,"request"=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户跳转
        return view("Admin.Admin.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Admininsert $request)
    {
        //执行添加用户
        $data = $request->except(['_token','repassword']);
        $data['password'] = Hash::make($data['password']);//加密密码
        if (DB::table("admin")->insert($data)) {
            return redirect("/admin")->with("success","添加成功");
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
        //修改角色
        $user = DB::table("admin")->where("id","=",$id)->get();
        return view("Admin.Admin.edit",["user"=>$user[0]]);
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
        //执行修改
        $result = DB::table("admin")->where("id","=",$id)->first();
        $oldpassword = $request->input("oldpassword");
        $data['password'] = $request->input("password");
        //加密密码
        $data['password'] = Hash::make($data['password']);
        $data['admin_name'] = $request->input("admin_name");
        //判断有没有空字段
        if (empty($data['password'] || empty($data['admin_name']))) {
            return back()->with('error','信息不能为空');
        }
        //判断旧密码
        if (Hash::check($oldpassword,$result->password)) {
            //执行修改
            if(DB::table("admin")->where("id","=",$id)->update($data)){
                return redirect("/admin")->with('success','修改成功');
            }
        }else{
            return back()->with('error','旧密码不正确');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        DB::table("admin")->where("id","=",$id)->delete();
        return redirect("/admin")->with("success","删除成功");
    }

    //后台首页
    public function adminindex(){
        return view("Admin.index");
    }

    //分配角色
    public function role($id){
        $user = DB::table("admin")->where("id","=",$id)->first();
        $role = DB::table("role")->get();
        $data = DB::table("admin_role")->where("uid","=",$id)->get();
        if (count($data)) {
            $rid[] = $data[0]->rid;
            return view("Admin.Admin.role",["user"=>$user,"role"=>$role,"rid"=>$rid]);
        }else{
            return view("Admin.Admin.role",["user"=>$user,"role"=>$role,"rid"=>array()]);
        }
    }

    //执行分配角色
    public function dorole(Request $request){
        //获取修改角色所需要的uid和rid
        $rid = $_POST['rid'];
        $uid = $request->input("uid");
        //放到数组中以便操作
        $data['uid'] = $uid;
        $data['rid'] = $rid;
        //把原角色删除，创建新角色
        DB::table("admin_role")->where("uid","=",$uid)->delete();
        DB::table("admin_role")->insert($data);
        //返回管理员列表
        return redirect("/admin")->with("success","角色分配成功");
    }
}
