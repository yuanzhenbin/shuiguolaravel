<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
// use Config; 不使用config所以不调用

class WebUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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
        //添加会员详细信息
        
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
        //会员修改自己的个人信息
        $data = $request->except(['_token','_method']);
        $info=DB::table("user_info")->where("user_id",'=',$id)->first();
        //图片上传
        if($request->hasFile("pic")){//有图
            //初始化名字
            $name=time()+rand(1,10000);
            //获取后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            // var_dump($ext);exit;
            //把上传的图片移动到指定目录下
            $request->file('pic')->move('./upload/user/'.date("Y-m-d"),$name.".".$ext);

            //把上传的图片路径写入到$data里
            $data['pic']=trim('./upload/user/'.date("Y-m-d")."/".$name.".".$ext,'.');
            //执行修改
            if (DB::table("user_info")->where("user_id","=",$id)->update($data)) {
                if (!empty($data['name'])) {
                    session(['user_name'=>$data['name']]);
                }

                if (empty(session('pic'))) {//如果没有原图，不删除
                    session(['pic'=>$data['pic']]);
                    echo "<script>alert('修改成功');location='/user_info'</script>";
                    // return redirect("/user_info");
                }else{//如果有原图，把原图删除
                    unlink(".".$info->pic);
                    // $request->session()->pull("pic");
                    session(['pic'=>$data['pic']]);
                    echo "<script>alert('修改成功');location='/user_info'</script>";
                    // return redirect("/user_info")->with('success','修改成功');
                }
            }
        }else{//无图
            if (DB::table("user_info")->where("user_id","=",$id)->update($data)) {
                if (!empty($data['name'])) {
                    session(['user_name'=>$data['name']]);
                }
                echo "<script>alert('修改成功');location='/user_info'</script>";
                // return redirect("/user_info")->with('success','修改成功');
            }
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
        //
    }
}
