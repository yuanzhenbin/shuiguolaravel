@extends("WebPublic.public")
@section('web')
<!--找回密码样式-->
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
      <form id="reg-form" action="/forget" method="post">
        <ul>
         <li><label class="name">邮&nbsp;&nbsp;箱：</label><input name="email" id="email" type="text" easyform="email;real-time;" message="Email格式要正确" easytip="disappear:lost-focus;theme:blue;" class="text_Add"/></li>
         <li><label class="name">验 证 码：</label><input style="margin-right: 10px;" name="code" easyform="length:4" type="text"  class="text_verification"/><img src="/code" alt="" onclick="this.src=this.src=this.src+'?a=1'">{{session('error')}}</li>
        </ul>
        {{csrf_field()}}
         <div class="register-btn"><input style="border: 0px; " type="submit" value=" 密码找回 " class="btn_register"  /></div>
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
@section('title','找回密码')