<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\AdminUserinsert;
use App\Models\User;

class AdminJifenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //查询对应商品
        $k = $request->input('keywords');
        $result = DB::table('goods_jifen')->where('jifen_name','like','%'.$k.'%')->paginate(10);

        return view("Admin.Jifen.index",["result"=>$result,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加积分商品
        //查询出所有商品，用来加入积分商品库
        $result = DB::table('goods')->get();
        return view('Admin.Jifen.add',['result'=>$result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加
        $data = $request->except(['_token']);
        $data['jifen_pic'] = DB::table("goods")->where('goods_name',"=",$data['jifen_name'])->first()->pic;
        if (DB::table('goods_jifen')->insert($data)) {
            return redirect('/adminjifen')->with("success","添加成功");
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
        //积分商品，没有修改
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
        //redirect()
        $row = DB::table('goods_jifen')->where('id','=',$id)->delete();
        return redirect('/adminjifen')->with('success','删除成功');
    }
}
