<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\Http\Requests\Orderinsert;

class WebOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //跳转
        $cart = session('cart');
        $data = array();
        $info = array();
        $total = '';//总计
        if ($cart) {
            foreach ($cart as $k => $v) {
                $result = DB::table("goods")->where("id","=",$v['id'])->first();
                $info['id'] = $v['id'];//商品id
                $info['name'] = $result->goods_name;//商品名
                $info['pic'] = $result->pic;//商品图
                $info['price'] = $result->price;//单价
                $info['total'] = $result->total;//库存
                $info['num'] = $v['number'];//数量
                $info['sum'] = $info['price']*$info['num'];//小计
                $total += $info['sum'];//总计
                $data[] = $info;
            }
        } 
        $jifen = round($total/10);
        session(['jifen'=>$jifen]);
        // dd($data);
        $address = DB::table("user_address")->where("user_id","=",session('uid'))->get();
        return view("Web.Orders",['data'=>$data,'total'=>$total,'address'=>$address,'jifen'=>$jifen]);
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
    public function store(Orderinsert $request)
    {
        //
        $data = DB::table("user_address")->where("id","=",$request->input('address'))->first();
        //拼接要加到订单表的信息
        $arr['user_name'] = $data->name;//此处的名字是收货地址的收件人，不是用户名
        $arr['address'] = $data->city;  //地址
        $arr['phone'] = $data->phone;   //此处的电话是收货地址的电话
        $arr['user_id'] = session('uid');
        $arr['total'] = $request->input('total');           //总价
        $arr['addtime'] = date("Y-m-d H:i:s",time());       //生成订单时间
        $arr['code'] = session('uid').time().rand(1,10000); //订单号
        $arr['liuyan'] = $request->input('liuyan');
        $zhifu = $request->input('zhifu');                  //支付方式

        $orders_id = DB::table("orders")->insertGetId($arr);
        $order_name = '';
        if ($orders_id) {
            $cart = session('cart');
            $info = array();
            if ($cart) {
                foreach ($cart as $k => $v) {
                    $result = DB::table("goods")->where("id","=",$v['id'])->first();
                    $info['orders_id'] = $orders_id;            //订单id
                    $info['goods_id'] = $v['id'];               //商品id
                    $info['goods_name'] = $result->goods_name;  //商品名
                    $info['num'] = $v['number'];                //数量
                    $info['price'] = $result->price;            //价格
                    $info['pic'] = $result->pic;            //价格
                    DB::table("orders_info")->insert($info);
                    $order_name = $order_name.$result->goods_name;
                }
            }else{
                return back();//购物车session为空
            }
        }else{
            return back();//订单添加失败
        }
        // var_dump($arr);exit;
        switch ($zhifu) {
            case 1:
                session(['orders_id'=>$orders_id]);
                pay($arr['code'],$order_name,'0.01','易田商城');//$arr['total']真实价格
                break;
            
            case 2:
                // echo "<script>alert('暂时不支持微信支付')</script>";
                session(['orders_id'=>$orders_id]);
                return redirect("/payreturn");
                break;
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
        //
    }


    //支付成功
    public function payreturn(Request $request){
        //用户id
        $uid = session('uid');
        //成功结算的订单id
        $order_id = session('orders_id');
        //此订单包含的商品信息
        $goods_info = DB::table("orders_info")->where("orders_id","=",$order_id)->get();
        //结算成功后把商品库存减去卖出的数量,销量加上这个数
        foreach ($goods_info as $k => $v) {
            $num = $v->num;
            $gid = $v->goods_id;
            $g_info = DB::table("goods")->where("id","=",$gid)->first();
            $oldnum = $g_info->total;
            $oldsales = $g_info->sales;
            $goods['total'] = $oldnum-$num;
            $goods['sales'] = $oldsales+$num;
            DB::table("goods")->where("id","=",$gid)->update($goods);
        }
        //修改支付状态
        $arr['status'] = 1;
        //获取原积分
        $ujifen = DB::table("user_info")->where("user_id","=",$uid)->first()->jifen;
        //原积分加新积分
        $jifen['jifen'] = session('jifen') + $ujifen;
        //修改积分
        DB::table("user_info")->where("user_id","=",$uid)->update($jifen);
        DB::table("orders")->where("id","=",$order_id)->update($arr);//改变订单状态
        $request->session()->pull("order_id");//删除订单号
        $request->session()->pull("cart");//如果购买成功会清空购物车
        echo "<script>alert('购买成功，请等待发货');location='/user'</script>";
    }

}
