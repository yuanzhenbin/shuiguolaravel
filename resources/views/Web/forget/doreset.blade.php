@extends('Webpublic.public')
@section('web')
<!--注册样式-->
<div class="Inside_pages clearfix">
 <div class="register">
     <div class="register_style">
      <div class="u_register">
      <div class="form-div">
      @if(count($errors)>0)
      <div>
        @foreach($errors->all() as $error)
          <h3 style="color:red;line-height: 34px;">{{ $error }}</h3>
        @endforeach
      </div>
      @endif
      <form id="reg-form" action="/doreset" method="post">
        <ul>
         <li><label  class="name">新 密 码：</label><input id="psw1" name="password" type="password"  class="text_Add" easyform="length:6-16;" message="密码必须为6—16位" easytip="disappear:lost-focus;theme:blue;"/></li>
         <li><label  class="name">确认密码：</label><input id="psw2" name="repassword" type="password"  class="text_Add" easyform="length:6-16;equal:#psw1;" message="两次密码输入要一致" easytip="disappear:lost-focus;theme:blue;"/></li>
        </ul>
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
         <div class="register-btn"><input style="border: 0px;" type="submit" value=" 重置密码 " class="btn_register"  /></div>
        </form>
      </div>
      </div>
     </div>
     <div class="register_img"><img src="/static/web/images/Register_img.png" /></div>
 </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#reg-form').easyform();
});
</script>
<!--底部样式-->
@endsection
@section('title','密码重置')