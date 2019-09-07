<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;

class ShopCartController extends Controller
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
                $info['describe'] = $result->describe;//数量
                $info['sum'] = $info['price']*$info['num'];//小计
                $total += $info['sum'];//总计
                $data[] = $info;
            }
        } 
        // dd($data);
        return view("Web.shopping_cart",['data'=>$data,'total'=>$total]);
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
        //加入购物车
        //push方法必须跳转到下一个页面才会保存
        $data=$request->except('_token');
        //判断购物车里有没有当前购买的数据 
        if(!$this->checkExists($data['id'])){
           $request->session()->push('cart',$data);
        } 
        return redirect("/shopping_cart");
        
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
        $data = session('cart');
        foreach($data as $key=>$value){
            if($value['id'] == $id){
                unset($data[$key]);
            }
        }
        //重新赋值
        session(['cart'=>$data]);
        return redirect("/shopping_cart");
    }

    //购物车去重 $id 购买商品数据id
    public function checkExists($id){
        //获取购物车数据
        $goods=session('cart');
        //判断
        //购物车没有数据
        if(empty($goods)) return false;
        //遍历
        foreach($goods as $key=>$value){
            //判断 购物车里有当前要购买的商品数据
            if($value['id']==$id){
                return true;
            }
        }
    }

    //减
    public function jian($id){
        $data = session('cart');
        foreach($data as $key=>$value){
            //如果商品id符合就执行减
            if($value['id'] == $id){
                //数量减一
                $num = $value['number']-1;
                $data[$key]['number'] = $num;
                if($data[$key]['number']<1){
                    $data[$key]['number'] = 1;
                }
            }
        }
        //重新赋值
        session(['cart'=>$data]);
        return redirect("/shopping_cart");
    }

    //加
    public function jia($id){
        $data = session('cart');
        foreach($data as $key=>$value){
            //如果商品id符合就执行减
            if($value['id'] == $id){
                //数量加一
                $num = $value['number']+1;
                $data[$key]['number'] = $num;
                $info = DB::table("goods")->where("id",'=',$id)->first();
                //判断数量不能超过库存
                if($data[$key]['number']>$info->total){
                    $data[$key]['number'] = $info->total;
                }
            }
        }
        //重新赋值
        session(['cart'=>$data]);
        return redirect("/shopping_cart");
    }

}
