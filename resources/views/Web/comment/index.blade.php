@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<script>
  $(".xianshitest").hover(function(){
      $(".xianshitest div").show();
  },function(){
      $(".xianshitest div").hide();
  });
</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="right Search">
   <form>
    <input name="" type="text"  class="Search_Box"/>
    <input name="" type="button"  name="" class="Search_btn"/>
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
       <li><a href="/user_comment"><em></em><span>我的评论</span></a></li>
       <li><a href="/user_integral"><em></em><span>我的积分</span></a></li>
       <li><a href="/user_Collect"><em></em><span>我的收藏</span></a></li>
       <li><a href="/user_address"><em></em><span>收货地址管理</span></a></li>
      </ul>
    </div>
    <!--右侧样式-->
    <div class="user_right">
      <div class="user_Borders">
       <div class="title_name">
        <span class="name">我的评论</span>
       </div>
        <div class="about_user_info">
         <form id="form1" name="form1" method="post" action="/comments">   
          <div class="user_layout" style="position: relative;">
            <div style=" position: absolute; left: -150px; width: 100px; height: 100px;">
              <img style="width: 80px; height: 80px;" src= @if(empty($res->pic)) "/static/web/images/product_img_17.png" @else {{$res->pic}} @endif /><br/>
              <span>{{$res->goods_name}}</span>
            </div>
            <input type="hidden" name="goods_id" value="{{$res->id}}">
            <input type="hidden" name="order_id" value="{{$order_id}}">
            <textarea name="content" class="form-control" placeholder="写下你对商品的评论" rows="6" cols="100" style="border:1px solid #e0e0e0"></textarea>
            {{csrf_field()}}
            <input type="submit" style="background: #ff6700; border: 0px; width: 80px; height: 30px; color: #fff; cursor: pointer;" value="提交评论">     
            @if(session('error'))    
                <span style="color: red;">{{session('error')}}</span>
            @endif
          </div>
         </form>
       </div>
      </div>
    </div>
  </div>
</div>
</body>
<!-- 底部样式 -->
@endsection
@section('title','商品评论')




