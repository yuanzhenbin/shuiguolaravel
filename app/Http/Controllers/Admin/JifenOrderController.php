<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class JifenOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //订单列表
        $key = $request->input('keywords');
        if (!$key == '') {
            $keys = DB::table('user_info')->where('name','=',$key)->first();
            if ($keys == '') {
                return back()->with('error','此用户没有积分订单');
            }else{
                $k = $keys->user_id;
            }
        }else{
             $k = '';
        }
        $data = DB::table('orders_jifen')->where('user_id','like','%'.$k.'%')->orderBy('user_id')->paginate(15);
        //用户id  变为  用户名
        foreach ($data as $key => $value) {
            $data[$key]->user_name = DB::table('user_info')->where('user_id','=',$value->user_id)->first()->name;
        }
        return view('Admin.Orders.jifen',['data'=>$data,'request'=>$request->all()]);
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
        $data = DB::table("orders_info")->where("orders_id","=",$id)->get();
        // var_dump($data);exit;
        return view('Admin.Orders.info',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改订单状态
        $data = DB::table("orders_jifen")->where("id","=",$id)->first();
        return view('Admin.Orders.jifenedit',['data'=>$data]);
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
        $data = $request->except('_token','_method');
        // var_dump($data);exit;
        if (DB::table("orders_jifen")->where("id","=",$id)->update($data)) {
            return redirect('/jifenorder')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
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
        //删除无用订单
        if (DB::table('orders')->where('id','=',$id)->delete()) {
            return redirect('/adminorders')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

}
