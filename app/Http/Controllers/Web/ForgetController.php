<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Gregwar\Captcha\CaptchaBuilder;
use DB;
use Hash;
class ForgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 注销
        return view('Web.Forget.forget');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("Web.Login");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证登录
        $code = $request->input('code');
        $vcode = session('vcode');
        if($code == $vcode){
            $email = $request->input('email');
            $info = DB::table('user')->where('email','=',$email)->first();
            if ($info) {
                // 发送邮件
                $res = $this->sendMail($email,$info->id,$info->token);
                if($res){
                    echo "<script>alert('重置密码邮件已发送,请登录邮箱重置密码');location='/login'</script>";
                    // echo "重置密码邮件已发送请登录邮箱重置密码";
                }
            }else{
                echo "<script>alert('邮箱有误');location='/forget'</script>";
            }     
        }else{
            echo "<script>alert('验证码有误');location='/forget'</script>";
            // return redirect("/forget")->with('error','校验码有误');
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

    public function sendMail($email,$id,$token){
        // 在闭包函数内部使用闭包函数外部的变量 必须use导入 a是模板
        Mail::send('Web.Forget.reset',['id'=>$id,'token'=>$token],function($message)use($email){
            $message->subject('重置密码');
            $message->to($email);
        });
        return true;
    }

    public function reset(Request $request){
        $id=$request->input('id');
        $info=DB::table('user')->where('id','=',$id)->first();
        $token=$request->input('token');
        // 对比邮件的token和数据表的token
        if($token==$info->token){
            return view('Web.Forget.doreset',['id'=>$id]);
        }
    }

    public function doreset(Request $request){
        $password = $request->input('password');
        $id = $request->input('id');
        $data['password'] = Hash::make($password);
        // 重新赋值
        $data['token'] = rand(1,10000);
        if(DB::table("user")->where('id','=',$id)->update($data)){
            echo "<script>alert('重置密码成功,请使用新密码登录');location='/login'</script>";
        }
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
