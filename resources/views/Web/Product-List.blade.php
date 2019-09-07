@extends("WebPublic.public")
@section('web')

<script src="/static/web/js/jquery.SuperSlide.2.1.1.js" type="text/javascript"></script>
<script>$("#Navigation").slide({titCell:".Navigation_name li"});</script>
<!---->
<div><a href="#"><img src="/static/web/images/AD_page_img_02.png" width="100%"/></a></div>
<!--位置-->
<div class="Bread_crumbs">
 <div class="Inside_pages clearfix">
   <div class="left">当前位置：<a href="/index">首页</a>&gt;<a href="#">{{$result->type_name}}</a></div><!-- 根据父id查的名字 -->
   <div class="right Search">
   <form action="/search" method="get">
    <input name="keywords" type="text"  class="Search_Box" placeholder="输入商品名"/>
    <input type="submit" value="" class="Search_btn"/>
   </form>
   </div>
 </div>
</div>
<!--产品列表-->
<div class="Inside_pages clearfix">
<div class="margintop">
 <DIV class="left_style">
   <div class="title_img_p" style="color: #fff; font-size: 40px;text-align: center; line-height: 140px;">{{$result->type_name}}馆</div>
   <div class="ranking">
    <div class="ranking_title"><span>推荐</span></div>
    <ul class="ranking_list">
    <?php $i=1 ?>
    @foreach($commend as $row)
     <li class="">
     <em class="ranking_label">{{$i++}}</em>
     <a href="/Product_detailed/{{$row->id}}" class="img"><img src="{{$row->pic}}" width="100px" height="100px" /></a>
     <p class="ranking_name">{{$row->goods_name}}</p>
     <p class="price"><b>￥</b>{{$row->price}}</p>
     <p><a href="/Product_detailed/{{$row->id}}">立即查看</a></p>
     </li>
    @endforeach
    </ul>
   </div>
 </DIV>
 <DIV class="right_style">
    <ul class="list_style">
    @foreach($data as $row)
      <li class="clearfix">
        <div class="product_lists clearfix">
          <a href="/Products_lists/{{$row->id}}"><img style="width: 207px; height: 219px;" src= @if(empty($row->pic)) "/static/web/images/product_img_17.png" @else {{$row->pic}} @endif /></a>
          <p style="margin-top: 10px;" class="btn_style"><span style="line-height: 33px; font-size: 20px; margin-left: 20px;">{{$row->type_name}}</span><a href="/Products_lists/{{$row->id}}" style="display: inline-block; float: right; width: 88px; height: 33px; background: #70b701; border-radius: 4px; color: #fff; text-align: center; line-height: 33px;">点击前往</a></p>
        </div>
      </li>
    @endforeach
    </ul>
 </DIV>
 </div>
</div>
<!--底部样式-->
@endsection
@section('title',$result->type_name.'馆')
