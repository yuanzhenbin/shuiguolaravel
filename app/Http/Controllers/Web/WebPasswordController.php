<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\Passwordinsert;//修改密码中间件
// use Config; 不使用config所以不调用

class WebPasswordController extends Controller
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
        //修改角色
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Passwordinsert $request, $id)
    {
        //执行修改
        $result = DB::table("user")->where("id","=",$id)->first();
        $oldpassword = $request->input("oldpassword");
        $data['password'] = $request->input("password");
        //加密密码
        $data['password'] = Hash::make($data['password']);
        //判断旧密码
        if (Hash::check($oldpassword,$result->password)) {
            //执行修改
            if(DB::table("user")->where("id","=",$id)->update($data)){
                echo "<script>alert('修改成功');location='/user_Password'</script>";
                // return redirect("/user_Password")->with('success','修改成功');
            }
        }else{
            echo "<script>alert('旧密码不正确');location='/user_Password'</script>";
            // return back()->with('error','旧密码不正确');
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
