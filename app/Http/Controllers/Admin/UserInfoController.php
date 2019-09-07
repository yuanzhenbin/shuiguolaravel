<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\AdminUserinsert;
use App\Models\Userinfo;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //会员列表
        $k = $request->input("keywords");
        $data = Userinfo::where('name','like','%'.$k.'%')->paginate(5);
        return view("Admin.Userinfo.index",['data'=>$data]);
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
    public function store(AdminUserinsert $request)
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
        //不能修改会员的个人信息
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
        //执行修改
        $data=$request->except(['_token','_method']);
        // var_dump($data);exit;
        if(Userinfo::where("id",'=',$id)->update($data)){
            return redirect("/userinfo")->with('success','修改成功');
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
        //不能删除会员
    }

    //会员收藏
    public function collection($id){
        //一对多，所以不能用first()
        $data = DB::table("user_collection")->where("user_id","=",$id)->get();
        // dd($data);
        // $data如果有值就会执行，没值就自动跳过下面一步
        foreach($data as $k=>$v){
            //把会员每一个收藏，根据id在对应表查出的信息，加到数据中
            $data[$k]->username = DB::table("user_info")->where("user_id","=",$v->user_id)->first()->name; 
            $data[$k]->goods = DB::table("goods")->where("id","=",$v->goods_id)->first()->goods_name;     
        }
        
        return view("Admin.Userinfo.collection",["data"=>$data]);
    }

    //会员收货地址
    public function address($id){
        $data = DB::table("user_address")->where("user_id","=",$id)->get();
        foreach($data as $k=>$v){
            //把会员每一个地址，根据id在对应表查出的信息，加到数据中
            if ($v) {
                $data[$k]->username = DB::table("user_info")->where("user_id","=",$v->user_id)->first()->name; 
            }else{
                $data[$k]->username = '';
            }     
        }

        return view("Admin.Userinfo.address",["data"=>$data]);
    }
}
