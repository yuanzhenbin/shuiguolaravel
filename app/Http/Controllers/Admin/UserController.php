<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\AdminUserinsert;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //会员列表
        $k = $request->input("keywords");
        $data = User::where('username','like','%'.$k.'%')->paginate(5);
        return view("Admin.User.index",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户跳转
        return view("Admin.User.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserinsert $request)
    {
        //执行添加用户
        $data = $request->except(['repassword','_token']);
        $data['password'] = Hash::make($data['password']);
        $name = $data['username'];
        $arr['name'] = $name;
        $data['token'] = rand(1,10000);
        if (User::create($data)) {
            //获取添加成功的会员账号id,如果用DB,则使用insertGetid
            $id = User::where("username","=",$name)->first()->id;
            $arr['user_id'] = $id;
            //同步创建会员详情表基本信息
            DB::table("user_info")->insert($arr);
            return redirect("/adminuser")->with('success','添加成功');
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
        //修改会员账号状态
        $data = User::find($id);
        $username = $data->username;
        $status = $data->status;
        // var_dump($status);exit;
        return view("Admin.User.edit",["id"=>$id,"status"=>$status,"username"=>$username]);
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
        $data=$request->except(['_token','_method']);
        // var_dump($data);exit;
        if(User::where("id",'=',$id)->update($data)){
            return redirect("/adminuser")->with('success','修改成功');
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
        //不能删除会员
    }
}
