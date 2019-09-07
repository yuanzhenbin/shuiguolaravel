<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CarouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$pic=DB::table("pic")->get();
    	//dd($pic);
    	$pic=DB::table("pic")->paginate(3);
        return view("Admin.Carouse.index",['pic'=>$pic,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$pic=DB::table("pic")->get();
        return view("Admin.Carouse.add",['pic'=>$pic]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile("pic")){
            //初始化名字
            $name=time()+rand(1,10000);
                        //获取上传文件后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            //dd($ext);
            //移动到指定目录下
            $request->file("pic")->move("./upload/lunbo/",$name.".".$ext);
        
	        //dd($request->all());
	        //获取需要入库的参数
	        $data=$request->except(["_token","pic"]);
	        $data["url"]="./upload/lunbo/".$name.'.'.$ext;
	        //dd($data);
	        //执行添加
	        if(DB::table("pic")->insert($data)){
	            return redirect("/admincarouses")->with("success","添加成功");
	        }else{
	            return back()->with("error","添加失败");
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
    //删除
    public function destroy($id)
    {
        //echo $id;
        $data=DB::table("pic")->where("id","=",$id)->first();
        $info=DB::table("pic")->where("id","=",$id)->delete();
        if($info){
        	unlink($data->url);
            return redirect("/admincarouses")->with("success","删除成功");; 
        }
    }
}
