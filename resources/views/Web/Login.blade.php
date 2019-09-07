@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<div class="Inside_pages clearfix">
<!--登录样式-->
  <div class="login">
       <div class="style_login clearfix">
       <form action="/dologin" method="post">
          <div class="layout">
            <div class="login_title">登录</div>
            <div class="item item-fore1">
              <label for="loginname" class="login-label name-label"></label>
              <input name="username" type="text" class="text" placeholder="手机号/邮箱/用户名">
            </div>
            <div class="item item-fore2">
              <label for="nloginpwd" class="login-label pwd-label"></label>
              <input name="password" type="password" class="text" placeholder="用户密码"> 
            </div>
            @if(session('error'))    
              <div style="color: #ee7621;">
                  {{session('error')}}
              </div>
            @endif
            {{csrf_field()}}
            <div class="login-btn"><button type="submit" style="border: 0px;" class="btn_login">登&nbsp;&nbsp;&nbsp;&nbsp;录</button></div>
            <div class="login_link"><a href="/registered">免费注册</a> | <a href="/forget">忘记密码</a></div>
          </div>
          </form>
       </div>
       <div class="login_img"><img src="/static/web/images/login_img_03.png" /></div>
  </div>
</div>
<!--底部样式-->

@endsection
@section('title','登录')
