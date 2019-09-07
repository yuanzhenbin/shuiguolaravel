<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class AdminOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //订单列表
        $k = $request->input('keywords');
        $data = DB::table('orders')->where('user_name','like','%'.$k.'%')->orderBy('user_id')->paginate(10);
        return view('Admin.Orders.index',['data'=>$data,'request'=>$request->all()]);
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
        $data = DB::table("orders")->where("id","=",$id)->first();
        return view('Admin.Orders.edit',['data'=>$data]);
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
        if (DB::table("orders")->where("id","=",$id)->update($data)) {
            return redirect('/adminorders')->with('success','修改成功');
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
