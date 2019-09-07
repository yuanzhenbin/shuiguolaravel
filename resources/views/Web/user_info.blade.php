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
<!--用户中心-->
<div class="Inside_pages clearfix">
  <div class="clearfix user" >
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
    <div class="user_right">
      <div class="user_Borders">
       <div class="title_name">
        <span class="name">个人信息设置</span>
       </div>
       <div class="about_user_info">
       <form id="form1" name="form1" method="post" action="/webuserinfo/{{session('uid')}}" enctype="multipart/form-data">   
       <div class="user_layout">
         <ul >
          <li><label class="user_title_name">用户头像：</label><img style=" height: 100px; max-width: 600px;" src="{{$data->pic}}" alt=""></li>
          <li><label class="user_title_name"></label></li>
          <li><label class="user_title_name">修改头像：</label><input name="pic" type="file" class="add_text"/><em style="color: gray">不上传新头像<br/>默认不修改</em></li>
          <li><label class="user_title_name">用户昵称：</label><input name="name" type="text" value="{{$data->name}}" class="add_text"/></li>
          <li><label class="user_title_name">年    龄：</label><input name="age" type="text" value="{{$data->age}}" class="add_text" placeholder="我们尊重用户的个人隐私，您可以不写"/></li>
          <li><label class="user_title_name">用户性别：</label>               
                <label class="sex"><input type="radio" name="sex" value="1" @if($data->sex=='1') checked="checked" @endif/><span>男</span></label>
                <label class="sex"><input type="radio" name="sex" value="0" @if($data->sex=='0') checked="checked" @endif/><span>女</span></label> 
                <label class="sex"><input type="radio" name="sex" value="2" @if($data->sex=='2') checked="checked" @endif/><span>保密</span></label>            
          </li>         
         </ul>
         {{csrf_field()}} 
         {{method_field("PUT")}} 
         <div class="operating_btn"><input type="submit" value="提交"  class="submit—btn"/></div>
         </div>
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
<div style="height: 50px;"></div>
<!--底部样式-->
@endsection
@section('title','个人信息设置')
