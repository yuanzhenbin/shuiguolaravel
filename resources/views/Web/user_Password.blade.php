@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="right Search">
   <form action="/search" method="get">
    <input name="keywords" type="text"  class="Search_Box" placeholder="输入商品名"/>
    <input type="submit" value="" class="Search_btn"/>
   </form>
   </div>
 </div>
</div>
<!--修改密码样式-->
<div class="Inside_pages clearfix">
  <div class="clearfix user" >
  <!--左侧菜单栏样式-->
  <div class="user_left">
      <div class="user_info">
       <div class="Head_portrait"><img src= @if(empty(session('pic'))) "/static/web/images/product_img_17.png" @else {{session('pic')}} @endif  width="80px" height="80px"/><!--头像区域--></div>
       <div class="user_name">{{session("user_name")}}<!-- 用户名 --><a href="/user_info">[个人资料]</a></div>
      </div>
      <ul class="Section">
       <!-- <li><a href="#"><em></em><span>我的特色馆</span></a></li> -->
       <li><a href="/user_info"><em></em><span>个人信息</span></a></li>
       <li><a href="/user_Password"><em></em><span>修改密码</span></a></li>
       <li><a href="/user_Orders"><em></em><span>历史订单</span></a></li>
       <li><a href="/user_pinglun"><em></em><span>我的评论</span></a></li>
       <li><a href="/user_integral"><em></em><span>我的积分</span></a></li>
       <li><a href="/user_Collect"><em></em><span>我的收藏</span></a></li>
       <li><a href="/user_address"><em></em><span>收货地址管理</span></a></li>
      </ul>
    </div>
    <!--右侧样式-->
    <div class="user_right">
      <div class="user_Borders">     
       <div class="title_name">
        <span class="name">修改密码</span>
       </div>
       <!--修改密码样式-->
       <div class="about_user_info">
        <form id="form1" name="form1" method="post" action="/webpassword/{{session('uid')}}">   
       <div class="user_layout">
         <ul >
          <li><label class="user_title_name">原密码：</label><input name="oldpassword" type="password"  class="add_text"/><em>*</em></li>
          <li><label class="user_title_name">新密码：</label><input name="password" type="password"  class="add_text"/><em>*</em></li>
          <li><label class="user_title_name">确认新密码：</label><input name="repassword" type="password"  class="add_text"/><em>*</em></li>         
         </ul>
         {{csrf_field()}} 
         {{method_field("PUT")}} 
          @if(count($errors) > 0)  
          <div style="color: red;">
            @foreach ($errors->all() as $error)
              {{ $error }}
            @endforeach
          </div>   
          @endif
         <div class="operating_btn"><input name="name" type="submit" value="确认"  class="submit—btn"/></div>
         </div>
          </form>
        
       </div>
      </div>
    </div>
  </div>
</div>
</body>

@endsection
@section('title','修改密码')
