<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Registerinsert;//注册表单中间件
use Mail;
use Gregwar\Captcha\CaptchaBuilder;
use Hash;
use DB;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //跳转注册页面
        return view("Web.registered");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        echo "zhuce";exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Registerinsert $request)
    {
        //执行注册
        $code = $request->input('code');
        $vcode = session('vcode');
        if($code == $vcode){
            $data = $request->except('repassword','_token','code');
            $data['password'] = Hash::make($data['password']);
            $data['token'] = rand(1,10000);
            $arr['name'] = $data['username'];
            // var_dump($data);exit;
            if(User::create($data)){
                $id = User::where("username","=",$data['username'])->first()->id;
                $arr['user_id'] = $id;
                //同步创建会员详情表基本信息
                DB::table("user_info")->insert($arr);
                //向注册的邮箱发送邮件 激活用户 激活会状态0改为2
                $res = $this->sendMail($data['email'],$id,$data['token']);
                if($res){
                    echo "<script>alert('请登录邮箱激活账号后登录');location='/login'</script>";
                    // return redirect("/login")->with('success','添加成功');
                }
            }
        }else{
            return redirect("/registered")->with('error','校验码有误');
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

    // 发送纯文本 识图和数据 $email 接收方 $id 注册用户 $token 检验参数
    public function sendMail($email,$id,$token){
        // 在闭包函数内部使用闭包函数外部的变量 必须use导入 a是模板
        Mail::send('Web.Register.activtion',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->to($email);
            $message->subject('激活用户');
        });
        return true;
    }

    //执行激活
    public function activtion(Request $request){
        $id=$request->input('id');
        $token=$request->input('token');
        $info=DB::table('user')->where('id','=',$id)->first();
        if($token==$info->token){
            $data['status']=1;
            // 给token赋值
            $data['token']=rand(1,1000);
            DB::table('user')->where("id",'=',$id)->update($data);
            echo "<script>alert('激活成功');location='/login'</script>";
        }
        // echo "id".$id;
    }

    public function code(){
         //生成校验码代码
         ob_clean();
         //清除操作
         $builder = new CaptchaBuilder;
         ///可以设置图片宽高及字体
         $builder->build($width = 100, $height = 40, $font = null);
         ///获取验证码的内容
         $phrase = $builder->getPhrase();
         ///把内容存入session
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        // 输出校验码
        $builder->output();

    }
}
