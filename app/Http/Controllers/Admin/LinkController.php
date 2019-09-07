<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取搜索的关键词
        $k=$request->input("keywords");
        $link=DB::table("connection")->where("connection_name",'like',"%".$k."%")->paginate(6);
        return view("Admin.Link.index",['link'=>$link,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Admin.Link.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取所有参数
        //dd($request->all());
        $data=$request->except(['_token']);
        //dd($data);
        //执行添加
        if(DB::table("connection")->insert($data)){
            return redirect("/adminlinks")->with('success','添加成功');
        }else{           
            return back()->with('error','添加失败');
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
        //获取需要修改的数据
        $link=DB::table("connection")->where("id",'=',$id)->first();
        return view("Admin.Link.edit",['link'=>$link]);
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
        //echo $id;
        //获取修改后的数据
        //dd($request->all());
        $data=$request->except(['_token','_method']);
        //dd($data);
        //执行修改
        if(DB::table("connection")->where("id",'=',$id)->update($data)){
            return redirect("/adminlinks")->with("success","修改成功");
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
        //执行删除
        if(DB::table("connection")->where('id','=',$id)->delete()){
            return redirect("/adminlinks")->with('success','删除成功');
        }else{
            return redirect("/adminlinks")->with('error','删除失败');           
        }
    }
}
