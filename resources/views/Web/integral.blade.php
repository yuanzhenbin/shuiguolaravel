@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="left">当前位置：<a href="/index">首页</a>&gt;<a href="/integral">活动专区</a></div>
   <div class="right Search">
   <form action="/search" method="get">
    <input name="keywords" type="text"  class="Search_Box" placeholder="输入商品名"/>
    <input type="submit" value="" class="Search_btn"/>
   </form>
   </div>
 </div>
</div>
<!--积分商城-->
<div class="Inside_pages clearfix">
  <div class="integral_style">
   <div class="integral_title"><em></em>积分商城<span>POINTS MALL</span></div>
   <div class="integral_user">
     <div class="user_name left">
      <a href="#" class="left"><img src= @if(empty(session('pic'))) "/static/web/images/product_img_17.png" @else {{session('pic')}} @endif  width="58px" height="58px"/></a>
      <p class="left integral_user_name"><b>{{$userinfo->name}}</b> <a href="/user">会员中心</a></p>
     </div>
     <div class="integral left">我的积分：{{$userinfo->jifen}}<a href="/user_integral">[积分商品订单]</a></div>
   </div>
   <!--列表样式-->
    <div class="integral_p_list">
     <ul class="list_style">
     @foreach($data as $row)
      <li class="clearfix">
       <div class="product_lists clearfix">
        <a href=""><img style="width: 207px; height: 219px;" src= @if(empty($row->jifen_pic)) "/static/web/images/product_img_17.png" @else {{$row->jifen_pic}} @endif/></a>
        <p class="title_p_name" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$row->jifen_name}}</p>
        <p class="title_Profile" style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;">{{$row->describe}}</p>
        <p class="price" style="font-size: 20px;">所需积分:{{$row->jifen_price}}</p>
        <p class="btn_style"><a href="/jifenorders/{{$row->id}}/edit"  class="integral_buy_btn"></a></p><!-- onclick="return confirm('你确定要消耗积分直接购买该商品吗?');" -->
       </div>
      </li>
     @endforeach
    </ul>
    </div>
  </div>
</div>
<!--底部样式-->

@endsection
@section('title','积分商城')
