<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        //删除session信息
        $request->session()->pull("admin_name");
        $request->session()->pull("role_name");
        $request->session()->pull("nodelist");
        return redirect("/adminlogin");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $password = $request->input('password');
        $admin_name = $request->input('admin_name');
        $data = DB::table("admin")->where("admin_name","=",$admin_name)->first();
        if ($data) {
            if (Hash::check($password,$data->password)) {
                //把用户的名字加到session,以通过中间件验证
                session(['admin_name'=>$admin_name]);
                $result = DB::select("select ar.rid,node_name,cname,fname from admin_role as ar,role_node as rn,node where ar.rid=rn.rid and rn.nid=node.id and ar.uid={$data->id}");
                // var_dump($result);exit;
                // 默认所有人都能访问后台首页
                $nodelist["AdminController"][] = "adminindex";

                foreach ($result as $k => $v) {
                    $nodelist[$v->cname][] = $v->fname;
                    //如果有添加，加上执行添加
                    if ($v->fname == "create") {
                        $nodelist[$v->cname][] = "store";
                    }
                    //如果有修改，加上执行修改
                    if ($v->fname == "edit") {
                        $nodelist[$v->cname][] = "update";
                    }
                }
                //把用户的角色添加到session
                if($result){
                    $rid = $result[0]->rid;
                    $role_name = DB::select("select role_name from role where id={$rid}");
                    session(['role_name'=>$role_name[0]->role_name]);
                }else{
                    session(['role_name'=>"无权限者"]);
                }
                // session(['role_name'=>"root"]);
                //把用户角色的权限加到session,以判断可以进哪些页面
                session(['nodelist'=>$nodelist]);
                return redirect("/adminindex")->with('success','登录成功');
            }else{
                return back()->with('error','用户名或密码错误1');
            }  
        }else{
            return back()->with('error','用户名或密码错误2');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
