<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class JifenOrdersController extends Controller
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
        $uid = session('uid');
        $id = $request->input('id');
        $info = array();

        // echo $id;
        $goods = DB::table("goods_jifen")->where("id","=",$id)->first();
        $oldjifen = DB::table("user_info")->where("user_id","=",$uid)->first()->jifen;
        $jifen = $goods->jifen_price;
        $newjifen = $oldjifen-$jifen;

        if ($newjifen >= 0) {//积分足够
            $address = DB::table("user_address")->where("id","=",$request->input('address'))->first();
            //拼接要加到订单表的信息
            $info['user_name'] = $address->name;//此处的名字是收货地址的收件人，不是用户名
            $info['address'] = $address->city;  //地址
            $info['phone'] = $address->phone;   //此处的电话是收货地址的电话
            $arr['jifen'] = $newjifen;
            DB::table('user_info')->where("user_id","=",$uid)->update($arr);
            $info['code'] = '123'.$uid.time().rand(1,10000);//订单号
            $info['user_id'] = $uid;
            $info['jifen_name'] = $goods->jifen_name;       //积分商品名
            $info['total'] = $jifen;                        //消耗积分
            $info['addtime'] = date("Y-m-d H:i:s",time());; //添加时间
            DB::table("orders_jifen")->insert($info);
            echo "<script>alert('购买成功，可在 积分商品订单 或 我的积分 查看');location='/integral'</script>";
        }else{
            echo "<script>alert('购买失败，您的积分不足');location='/integral'</script>";
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
        $address = DB::table("user_address")->where("user_id","=",session('uid'))->get();
        $data = DB::table("goods_jifen")->where("id","=",$id)->first();
        return view("Web.jifen_cart",['data'=>$data,'address'=>$address]);
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
        //
    }

}
