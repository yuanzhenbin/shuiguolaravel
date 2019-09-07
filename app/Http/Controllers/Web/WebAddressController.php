<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class WebAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = DB::table("user_address")->where("user_id","=",session("uid"))->get();
        // var_dump($data);exit;
        return view('Web.user_address',["data"=>$data]);
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
        //添加用户收货地址
        $data = $request->except('_token','address');
        $data['city'] = $data['city'].','.$request->input('address');
        // dd($data);
        //往data中加入 用户id
        $data['user_id'] = session('uid');
        //连接数据库 添加数据
        $res = DB::table('user_address')->insert($data);
        //判断是否添加成功
        if ($res) {
            return redirect('/user_address');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
        //删除地址
        if (DB::table('user_address')->where('id','=',$id)->delete()) {
            return redirect('/user_address');
        }else{
            return back();
        }
    }


    public function address(Request $request)
    {
        //获取传过来的 upid 的值
        $upid = $request->input('upid');
        //连接数据库
        $list = DB::table('district')->where('upid','=',$upid)->get();
        //将对象遍历为数组
        foreach ($list as $key => $value) {
            $arr[$key][] = $value->name;
            $arr[$key][] = $value->id;
            $arr[$key][] = $value->level;
            $arr[$key][] = $value->upid;
            //var_dump($arr);
        }
        //var_dump($arr);
        //用js格式返回
        echo json_encode($list);
    }

    public function deladdress($id)
    {
        //删除地址 //从订单来
        if (DB::table('user_address')->where('id','=',$id)->delete()) {
            return redirect('/Orders');
        }else{
            return back();
        }
    }
    public function deladd($id)
    {
        //删除地址 从积分订单来
        if (DB::table('user_address')->where('id','=',$id)->delete()) {
            return back();
        }else{
            return back();
        }
    }
}
