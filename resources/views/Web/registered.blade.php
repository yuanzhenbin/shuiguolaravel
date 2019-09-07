@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>

<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--注册样式-->
<div class="Inside_pages clearfix">
 <div class="register">
    <ul>
      <li id="shou" style="width: 250px; height: 50px; float: left; line-height: 50px; text-align: center; font-size: 20px; background: #ff6700; color: #fff; cursor: pointer;">手机注册</li>
      <li id="you" style="width: 248px; height: 48px; float: left; border: 1px solid #e0e0e0; line-height: 50px; text-align: center; font-size: 20px; cursor: pointer;">邮箱注册</li>
    </ul>
    <!-- 手机注册 -->
    <div class="register_style" id="shouji">
      @if(count($errors)>0)
      <div>
        @foreach($errors->all() as $error)
          <p style="color:red;line-height: 24px;margin-left:40px;margin-top:5px;float:left;">{{ $error }}</p>
        @endforeach
      </div>
      @endif
      <div class="u_register">
        <div class="form-div">
          <form action="/homeregisters" method="post" id="ff">
          @if(session('error'))
          <div style="color: red;font-size: 18px">{{session('error')}}</div>
          @endif
           <div> 
            <ul> 
              <li style="margin-bottom: 0px;"><label class="name">手机号码：</label><input name="phone" type="text" class="text_Add" reminder="请输入正确的手机号"/><span></span></li><br/>
              <li style="margin-bottom: 0px;"><button style="display: block; width: 100px; height: 30px; background: #85ce2e; color: #fff; text-align: center; line-height: 30px; float: right; border: 0px; cursor: pointer;" href="javascript:void(0)" id="ss">获取校验码</button><span></span></li><br/>
              <li style="margin-bottom: 0px;"><label class="name">输入校验码:</label><input name="code" type="text" class="text_Add" reminder="请输入正确的验证码"/><span></span></li><br/>
              <li style="margin-bottom: 0px;"><label class="name">设置密码：</label><input name="password" id="password" class="text_Add" type="password" onBlur="check();"/><span id="xx"></span></li><br/>
              <li style="margin-bottom: 0px;"><label class="name">确认密码：</label><input name="password1" id="password1" class="text_Add" type="password" onkeyup='validate()'/><span id="oo"></span></li>
            </ul> 
              {{csrf_field()}}
              <div class="auto-register"><label class="auto-label"><span><a href="#">《国际商贸城网站注册协议》</a></span></label></div>
              <div class="register-btn"><input style="border: 0px; text-align: center; line-height: 40px;" type="submit" value=" 接受协议并注册 " class="btn_register" id="sub" /></div>
           </div> 
          </form>
        </div>
      </div>
    </div>
    <!-- 邮箱注册 -->
    <div class="register_style" id="youxiang" style="display: none;">
      @if(count($errors)>0)
      <div>
        @foreach($errors->all() as $error)
          <p style="color:red;line-height: 24px;margin-left:40px;margin-top:5px;float:left;">{{ $error }}</p>
        @endforeach
      </div>
      @endif
      <div class="u_register">
        <div class="form-div">
         <form id="reg-form" action="/registered" method="post">
          <ul>
           <li><label class="name">电子邮箱：</label><input name="email" id="email" type="text" class="text_Add"/></li>
           <li><label class="name">用户名称：</label><input name="username" id="uid" type="text" class="text_Add"/></li>
           <li><label  class="name">设置密码：</label><input id="psw1" name="password" type="password"  class="text_Add"/></li>
           <li><label  class="name">确认密码：</label><input id="psw2" name="repassword" type="password"  class="text_Add"/></li>
           <li><label class="name">验 证 码：</label><input style="margin-right: 10px;" name="code" type="text"  class="text_verification"/><img src="/code" alt="" onclick="this.src=this.src=this.src+'?a=1'">@if(session('error'))  
            <div style="color: red;">
              {{session('error')}}
            </div>  
            @endif
           </li>
          </ul>
          {{csrf_field()}}
          <div class="auto-register"><label class="auto-label"><span><a href="#">《国际商贸城网站注册协议》</a></span></label></div>
           <div class="register-btn"><input style="border: 0px; text-align: center; line-height: 40px;" type="submit" value=" 接受协议并注册 " class="btn_register"  /></div>
          </form>
        </div>
      </div>
    </div>
    <div class="register_img"><img src="/static/web/images/Register_img.png" /></div>
 </div>
</div>

<script type="text/javascript">
$("#shou").click(function(){
  $("#shouji").show();
  $("#youxiang").hide();
  $(this).css({"background":"#ff6700","color":"#fff","border":"0px","width":"250","height":"50"});
  $("#you").css({"background":"#fff","color":"#000","border":"1px solid #e0e0e0","width":"248","height":"48"});
});
$("#you").click(function(){
  $("#youxiang").show();
  $("#shouji").hide();
  $(this).css({"background":"#ff6700","color":"#fff","border":"0px","width":"250","height":"50"});
  $("#shou").css({"background":"#fff","color":"#000","border":"1px solid #e0e0e0","width":"248","height":"48"});
});

function check() {
 var answer= document.getElementById("password").value;
  if(answer.length<6) {
    document.getElementById("xx").innerHTML="<font color='red'>密码位数不能少于6个</font>";
    return false;
 }else{
    document.getElementById("xx").innerHTML="<font color='green'></font>";  
 }
}

$(function(){
  $("#sub").click(function(){
    var pwd = $("input[name='password']").val();
    var cpwd = $("input[name='password1']").val();
      if(pwd != cpwd){
      document.getElementById("oo").innerHTML="<font color='red'>两次密码不一致</font>";  
      $("input[name='password']").val("");
      $("input[name='password1']").val("");
      return false;
    }else{
      document.getElementById("oo").innerHTML="<font color='green'>两次密码一致</font>";  
    }
  });
});

var PHONE=false;
var CODE=false;
//alert($);
//获取每个input 绑定获取焦点事件
$("input").focus(function(){
  reminder=$(this).attr('reminder');
  $(this).next("span").css('color','red').html(reminder);
});

//获取手机号 绑定失去焦点事件
$("input[name='phone']").blur(function(){
  //获取手机号
  p=$(this).val();
  o=$(this);
  //正则匹配 match
  if(p.match(/^\d{11}$/)==null){
    // alert(p);
    $(this).next("span").css("color",'red').html('请输入正确的手机号');
    PHONE=false;  
  }else{
    //判断手机号码是否重复
    $.get("/checkphone",{p:p},function(data){
      if(data==1){
        o.next("span").css("color",'red').html('手机号已经注册');
        //把获取校验码按钮 设置禁用
        $("#ss").attr('disabled',true);
        PHONE=false;
      }else{
        o.next("span").css("color",'green').html('手机号可用');
        //把获取校验码按钮 设置激活
        $("#ss").attr('disabled',false);
        PHONE=true;
      }
    });
  }
});

//获取发送短信校验码按钮 绑定单击事件
$("#ss").click(function(){
s=$(this);  
  //获取注册的手机号
  pp=$("input[name='phone']").val();
  //Ajax
  $.get("/sendphone",{pp:pp},function(data){
     // alert(data);
    if(data.code==000000){
      m=60;
      //定时器
      mytime=setInterval(function(){
        m--;
        //m赋值按钮
        s.html(m+"秒后重新发送");
        s.attr('disabled',true);
        s.css("background","#e0e0e0");
        if(m==0){
          //清除定时器
          clearInterval(mytime);
          s.html("重新发送");
          s.attr('disabled',false);
          s.css("background","#85ce2e");
        }
      },1000);
    }
  },'json');
});

 //获取输入验证码input
$("input[name='code']").blur(function(){
  c=$(this);
  //获取输入的校验码
  code=$(this).val();
  $.get("/checkcode",{code:code},function(data){
    if(data==1){
      //校验码一致
      c.next("span").css('color','green').html('校验码一致');
      CODE=true;
    }else if(data==2){
      //校验码不一致
      c.next("span").css('color','red').html('校验码有误');
      CODE=false;
    }else if(data==3){
      //输入校验码为空
      c.next("span").css('color','red').html('校验码为空');
      CODE=false;
    }else if(data==4){
      //验证码过期
      c.next("span").css('color','red').html('校验码已过期');
      CODE=false;
    }
  });
 });

//表单提交
$("#ff").submit(function(){
//trigger 某个元素触发某个事件
$("input").trigger("blur");
if(PHONE && CODE){
  return true;//成功提交
}else{
  return false;
} 
});
</script>
<!--底部样式-->
@endsection
@section('title','用户注册')
