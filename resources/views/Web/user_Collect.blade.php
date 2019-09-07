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
<!--用户中心(收藏)-->
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
     <!--右侧内容样式-->
   <div class="user_right">
    <div class="user_Borders clearfix">
    <div class="title_name">
        <span class="name">用户收藏</span>
       </div>
   <!--收藏样式-->
    <div class="Collect">
      <div id="uid">
      <ul class="Collect_list">
      @foreach($data as $row)
       <li>
       <div class="Collect_pro_name">
         <a href="/del_collection/{{$row->id}}" class="delete_Collect"></a>
        <p class="img center">
        <a href="/Product_detailed/{{$row->id}}"><img src= @if(empty($row->pic)) "/static/web/images/product_img_17.png" @else {{$row->pic}} @endif  width="180px" height="180px"/></a></p>
        <p><a href="/Product_detailed/{{$row->id}}">{{$row->goods_name}}</a></p>
        <p class="Collect_price">￥{{$row->price}}</p>
        </div>
       </li>
      @endforeach
      </ul>
      </div>
      <!--分页-->
      <div class="pages_Collect clearfix mystyle" style="float: right;">
        @foreach($pp as $v)
        <a href="javascript:void(0)" onclick="page({{$v}})" title="">{{$v}}</a>
        @endforeach
      </div>
    </div>
    
    </div>
   </div>
  </div>
 </div>

<script>
  //ajax分页

   function page(page){
    $.get('/user_Collect',{page:page},function(data){
      // alert(1);
      $('#uid').html(data);
    });
   }
</script>

 <!--底部样式-->
@endsection
@section('title','我的收藏')
