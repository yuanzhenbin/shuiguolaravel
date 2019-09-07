<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取传过来的搜索值
        $key = $request->input('keywords');
        if (!$key == '') {
            $keys = DB::table('user_info')->where('name','=',$key)->first();
            if ($keys == '') {
                return back()->with('error','此用户没有评论');
            }else{
                $k = $keys->user_id;
            }
        }else{
             $k = '';
        }
        /*dd($k);*/
        //连接数据库导出评论数据
        $result = DB::table('message')->where('user_id','like','%'.$k.'%')->orderBy('goods_id')->paginate(10);
        //用户id  变为  用户名
        foreach ($result as $key => $value) {
            $result[$key]->user_name = DB::table('user_info')->where('user_id','=',$value->user_id)->first()->name;
        }
        //商品id变商品名
        foreach ($result as $key => $value) {
            $result[$key]->goods_name = DB::table("goods")->where("id","=",$value->goods_id)->first()->goods_name;
        }
        //dd(time());
        //导入页面
        return view('Admin.Message.index',['result'=>$result,'request'=>$request->all()]);
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
        //
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
        //连接数据库删除语句
        $res = DB::table('message')->where('id','=',$id)->delete();
        if ($res) {
            return redirect('/adminmessage')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }
}
