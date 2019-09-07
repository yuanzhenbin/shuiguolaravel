<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Models\User;
class RegistersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    public function checkphone(Request $request)
    {
        $p=$request->input('p');
        
        $phone=DB::table("user")->pluck('phone');
        //获取对象集合转换为数组
        $arr=array();
        foreach($phone as $key=>$v){
            $arr[$key]=$v;
        }
        if(in_array($p,$arr)){
            echo 1;//可以注册
        }else{
            echo 0;
        }
    }

    public function sendphone(Request $request){
        $pp=$request->input('pp');
        //echo $pp;
        //调用短信接口
        sendphone($pp);
    }


    public function checkcode(Request $request)
    {
        //获取输入的校验码
        $code=$request->input('code');
        if(isset($_COOKIE['fcode']) && !empty($code)){
            //获取手机号收到的校验码
            $fcode=$request->cookie('fcode');
            if($fcode==$code){
                echo 1;//校验码一致
            }else{
                echo 2;//不一致
            }
        }elseif(empty($code)){
            echo 3;//为空
        }else{
            echo 4;//过期
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行注册
        $data = $request->except('password1','_token','code');
        $data['password'] = Hash::make($data['password']);
        $data['token'] = rand(1,10000);
        //手机注册默认用户名
        $data['username'] = $data['phone'];
        $data['status'] = 1;
        $arr['name'] = $data['phone'];
        // var_dump($data);exit;
        if(User::create($data)){
            $id = User::where("username","=",$data['username'])->first()->id;
            $arr['user_id'] = $id;
            //同步创建会员详情表基本信息
            DB::table("user_info")->insert($arr);
            echo "<script>alert('注册成功');location='/login'</script>";
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
    public function destroy($id)
    {
        //
    }
}
