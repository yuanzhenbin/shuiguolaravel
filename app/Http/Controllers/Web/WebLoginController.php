<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class WebLoginController extends Controller
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
        $request->session()->pull("user_name");
        $request->session()->pull("uid");
        $request->session()->pull("pic");
        $request->session()->pull("shoucang");
        $request->session()->pull("cart");
        return redirect("/login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加会员session
        $password = $request->input('password');
        $username = $request->input('username');
        $data = DB::table("user")->where("username","=",$username)->first();
        // var_dump($data);exit;
        if ($data) {
            if (Hash::check($password,$data->password)) {
                if ($data->status == 1) {
                    //查询用户详情
                    $userinfo = DB::table("user_info")->where("user_id","=",$data->id)->first();
                    //查询用户收藏
                    $collection = DB::table("user_collection")->where("user_id","=",$data->id)->get();
                    //定义收藏空数组
                    $shoucang = array();
                    // 把用户收藏的商品的id加到收藏数组
                    foreach ($collection as $k => $v) {
                        $shoucang[$k] = $v->goods_id;
                    }
                    //把用户的名字加到session,以通过中间件验证
                    session(['user_name'=>$userinfo->name]);
                    //把用户id加到session方便查询
                    session(['uid'=>$userinfo->user_id]);
                    //把用户头像加到session方便查询
                    session(['pic'=>$userinfo->pic]);
                    //把用户收藏的商品的id加到session方便查询
                    session(['shoucang'=>$shoucang]);
                    return redirect("/user");
                }else{
                    return back()->with('error','您的账号尚未激活');
                }
            }else{
                return back()->with('error','用户名/邮箱或密码错误');//就是密码错误
            }  
        }else{
            //邮箱登录
            $data = DB::table("user")->where("email","=",$username)->first();
            if ($data) {
                if (Hash::check($password,$data->password)) {
                    if ($data->status == 1) {
                        //查询用户详情
                        $userinfo = DB::table("user_info")->where("user_id","=",$data->id)->first();
                        //查询用户收藏
                        $collection = DB::table("user_collection")->where("user_id","=",$data->id)->get();
                        //定义收藏空数组
                        $shoucang = array();
                        // 把用户收藏的商品的id加到收藏数组
                        foreach ($collection as $k => $v) {
                            $shoucang[$k] = $v->goods_id;
                        }
                        //把用户的名字加到session,以通过中间件验证
                        session(['user_name'=>$userinfo->name]);
                        //把用户id加到session方便查询
                        session(['uid'=>$userinfo->user_id]);
                        //把用户头像加到session方便查询
                        session(['pic'=>$userinfo->pic]);
                        //把用户收藏的商品的id加到session方便查询
                        session(['shoucang'=>$shoucang]);
                        return redirect("/user");
                    }else{
                        return back()->with('error','您的账号尚未激活');
                    }
                }else{
                    return back()->with('error','用户名或密码错误');//就是密码错误
                }
            }else{
                //手机号登录
                $data = DB::table("user")->where("phone","=",$username)->first();
                if ($data) {
                    if (Hash::check($password,$data->password)) {
                        //查询用户详情
                        $userinfo = DB::table("user_info")->where("user_id","=",$data->id)->first();
                        //查询用户收藏
                        $collection = DB::table("user_collection")->where("user_id","=",$data->id)->get();
                        //定义收藏空数组
                        $shoucang = array();
                        // 把用户收藏的商品的id加到收藏数组
                        foreach ($collection as $k => $v) {
                            $shoucang[$k] = $v->goods_id;
                        }
                        //把用户的名字加到session,以通过中间件验证
                        session(['user_name'=>$userinfo->name]);
                        //把用户id加到session方便查询
                        session(['uid'=>$userinfo->user_id]);
                        //把用户头像加到session方便查询
                        session(['pic'=>$userinfo->pic]);
                        //把用户收藏的商品的id加到session方便查询
                        session(['shoucang'=>$shoucang]);
                        return redirect("/user");
                    }else{
                        return back()->with('error','用户名或密码错误');//就是密码错误
                    }
                }else{
                    return back()->with('error','用户不存在');//空
                }
            }
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
